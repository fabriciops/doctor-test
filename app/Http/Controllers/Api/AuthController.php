<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request){

        try {
            $login  = $request->only('email', 'password');
            $token = Auth::attempt($login);
            if($token){
                return response()->json(['mensagem' => 'Usuário logado com sucesso', 'token'=> $token], 200);
            }
            return response()->json(['mensagem' => 'Email ou senha incorretos'], 401);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro no serviodor'], 500);
        }
       
    }

    public function logout() {
        try {
            Auth::logout();
            return response()->json(['mensagem' => 'Usuário deslogado com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro no serviodor'], 500);
        }
        
    }

    public function token() {
        try {
            $user =  auth()->user();
            return response()->json(['mensagem' => 'Usuário validado com sucesso', 'validação'=> $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na validação do usuáriono serviodor'], 401);        
        }
        

    }
}
