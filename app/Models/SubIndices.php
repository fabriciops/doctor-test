<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubIndices extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'pagina',
        'subindices',
        'indices_id',
    ];

    public static function getDadosLivroSubIndices($params, $query){
        
        $data = DB::table('sub_indices')
            ->join('indices', 'indices.id', '=', 'sub_indices.indices_id')
            ->join('livros', 'livros.id', '=', 'indices.livro_id')
            ->where("sub_indices.{$params}" , 'LIKE', "%{$query}%")
            ->select('*')
            ->get();
        
        return $data;
    }

    public function getIndices(){
        return $this->belongsTo(Indices::class, 'indices_id', 'id');
    }

}
