<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Hash;

class UsuarioServices
{
    public $id_usuario;
    public $email;
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public static function criarUsuario(array $data)
    {
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' =>'',
            'type' => 1,
            
        ]);

        return false;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function update($params, $id)
    {
        try {

            $userUpdate = [
                'name' => $params['name'],
                'email' => $params['email'],
                'contact' => $params['contact'],
                'password' => Hash::make($params['password']),
            ];
            
            $user = User::find($id);

            if ($user->update($userUpdate)) {
                return response()->json(['status' => true, 'message' => 'Dados atualizados com sucesso']);
            }
            
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Não foi possível atualizar os Dados']);
        }
    }
}