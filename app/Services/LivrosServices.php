<?php
namespace App\Services;

use App\Models\Indices;
use App\Models\SubIndices;
use App\Models\User;

use App\Models\Livros;


class LivrosServices
{
    public static function getLivros(){

        return Livros::all();
    }
    
    public static function cadastrar($data){

        $livro = Livros::create([
            'titulo'=>$data['titulo'],
            'user_id' => auth()->user()->id
        ]);
        
        if(self::registrarIndices($livro->id, $data['indices'])){
            return true;
        }
        return false;
    }

    public static function registrarIndices($livro, $indices){

        for ($i=0; $i < count($indices); $i++) {
            $indice = [
                "titulo" => $indices[$i]['titulo'],
                "pagina" => $indices[$i]['pagina'],
                "livro_id" => $livro
            ];

            $indice_id = Indices::create($indice);
            
            if(!empty($indices[$i]['subindices'])){
                return !empty(self::registrarSubIndices($indice_id->id, $indices[$i]['subindices']));
            }
        }
    }

    public static function registrarSubIndices($indice_id, $subindices){
        for ($i=0; $i < count($subindices); $i++) {
            $subIndice = [
                "titulo" => $subindices[$i]['titulo'],
                "pagina" => $subindices[$i]['pagina'],
                "indices_id" => $indice_id
            ];
        }
        $registro = SubIndices::create($subIndice);
        return $registro->id;
    }

    public static function getAll(){
       return $livros = Livros::all();
    }

    public static function ordenalista($lista, $modo = null){
        
        switch ($modo) {
            case 'livro':
                return self::listaLivros($lista);
                break;
        }
    }

    public static function listaLivros($livros){
        
        $livrosArr = [];
        
        for ($i=0; $i < count($livros); $i++) {
            $livrosArr[$i] = [
                'titulo' => $livros[$i]['titulo'],
                'usuario_publicador' => User::where('id', '=', $livros[$i]['user_id'])->select('id', 'name')->get()
            ];
            $indices = Indices::where('livro_id', $livros[$i]['id'])->get();
            if(!empty($indices)){
                foreach ($indices as $value) {
                    
                    $livrosArr[$i]['indices'] = [
                        'id' => $value['id'],
                        'titulo' => $value['titulo'],
                        'pagina' => $value['pagina'],
                    ];
                    $subIndices = SubIndices::where('indices_id', $value['id'])->select('id', 'titulo','pagina', 'subindices')->get();   
                    $livrosArr[$i]['indices']['subIndices'] = !empty($subIndices) ? $subIndices : [];
                }                        
            }   
        }
        return $livrosArr;
    }
    
}