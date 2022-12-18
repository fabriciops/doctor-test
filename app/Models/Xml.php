<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xml extends Model
{
    protected $table = 'xml';

    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'id',
        'xml',
        'livro_id',
    ];

}
