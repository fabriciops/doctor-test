<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LivrosController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\ReadXmlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/unauthenticated', function(){
    return ['error' => 'Usuario não está logado'];
})->name('login');

Route::prefix('v1')->group(function () {
    Route::post('/register', [RegisterController::class,'registrarUsuario']);
    Route::post('/login', [AuthController::class,'login']);

    Route::middleware('auth:api')->group(function(){
        Route::post('/auth/token', [AuthController::class,'token']);
        Route::post('/logout', [AuthController::class,'logout']);
        //cadastrar livros
        Route::post('/livro', [LivrosController::class,'cadastrarLivro']);
        //mostrar lista de livros
        // Route::any('livros/{variavel?}', [LivrosController::class,'seach']);
        //mostrar lista de livros
        Route::get('/getLivrosPorUsuario', [LivrosController::class,'getLivrosPorUsuario']);

        // Route::get('/livros/{nome?}', function (String $nome = "não informou"){
        //     echo "minha nova rota é $nome";
        // });

        
        Route::post('/livros/{livro}/importar-indices-xml', [ReadXmlController::class,'import']);

        Route::get('livros', [LivrosController::class,'seach']);

    });

});

