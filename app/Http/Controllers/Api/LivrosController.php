<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Indices;
use App\Models\Livros;
use App\Models\SubIndices;
use App\Models\User;
use App\Services\LivrosServices;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LivrosController extends Controller
{
    public function cadastrarLivro(Request $request){
        try {
            if(!empty($request['titulo'])){
                LivrosServices::cadastrar($request);
                return response()->json(['mensagem' => 'Livro cadastrado com sucesso'], 200);
            }
            return response()->json(['mensagem' => 'Você não informou os indices ou titulo para o cadastro livro'], 401);

        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['mensagem' => 'Erro no servidor'], 500);
        }
    }

    public function getLivros(Request $request){
        $livros = LivrosServices::getAll();
        return response()->json($livros->publicador, 200);
    }

    public function getLivrosPorUsuario(Request $request){
        $usr = User::find($request->id);
        return response()->json($usr->livros, 200);
    }

    public function seach(Request $request)
    {
        try {
            $query = $request->query();        
            if(!empty($query['titulo'])){
                return response()->json($this->getLivrosData('titulo','LIKE',$query['titulo']), 200);
            }else{
                $arr = Indices::where('titulo', 'LIKE', "%{$query['titulo_do_indice']}%")->get();
                if(count($arr) == 0){
                    $arr = SubIndices::where('titulo', 'LIKE', "%{$query['titulo_do_indice']}%")->get();
                    $data = [];
                    foreach ($arr as $value) {
                        $livro = Livros::getLivroSeach('id', $value->getIndices->livro_id);
                        $arr = LivrosServices::ordenalista($livro);
                        array_push($data, $arr);
                    }
                }else{
                    $data = [];
                    foreach ($arr as $value) {
                        $lista = $this->getLivrosData('id','=',$value['id']);
                        array_push($data, $lista);
                    }
                }
                return response()->json($data, 200);
            }
            return response()->json(['mensagem' => 'Nenhum registro encontrado'], 401);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['mensagem' => 'Erro no servidor'], 500);
        }
    }

    public function getLivrosData($param, $condicional, $query){
        $livros  = Livros::where("$param", "$condicional", "$query")->get();
        return LivrosServices::listaLivros($livros);
    }
}