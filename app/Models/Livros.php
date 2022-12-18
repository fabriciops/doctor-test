<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Livros extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'titulo',
        'user_id',
    ];

    public function publicador(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function livros(){
        return $this->hasMany(Indices::class, 'livro_id', 'id');
    }

    public static function getDadosLivro($params, $query){
        $data = DB::table('livros')
            ->join('indices', 'indices.livro_id', '=', 'livros.id')
            ->join('sub_indices', 'sub_indices.indices_id', '=', 'indices.id')
            ->where("livros.{$params}" , 'LIKE', "%{$query}%")
            ->select('*')
            ->get();
            
            return $data;
    }

    public static function getLivroSeach($params, $query){
        if($params == 'id'){
            return Livros::find($query);
        }
        return Livros::where("{$params}", 'LIKE', "%{$query}%")->get();
    }
    
    
}

