<?php

namespace App\Services;
use App\Models\Xml;

class XmlServices{
    public static function create($data){

        $data = [
            'xml' => $data['xml'],
            'livro_id'=> $data['livro_id']
        ];
        
        Xml::create($data);
        return true;
        
    }
}