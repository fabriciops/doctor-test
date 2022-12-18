<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\SubIndices;

class Indices extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'pagina',
        'indice_pai_id',
        'livro_id'
    ];


    public function subIndices(){
        return $this->hasMany(SubIndices::class, 'indices_id', 'id');
    }

    public function subIndices_() {
        return $this->hasMany('App\SubIndices');    
    }
}
