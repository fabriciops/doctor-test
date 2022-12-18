<?php

namespace App\Http\Controllers;

use App\Jobs\xmlJob;
use App\Services\XmlServices;
use Illuminate\Http\Request;

class ReadXmlController extends Controller
{
    public function import(Request $request){
        
        $xmlDataString = $request->getContent();
        $xmlObject = simplexml_load_string($xmlDataString);        
        $json = json_encode($xmlObject);

        $data = [
            'xml' => $json,
            'livro_id'=> $request->livro
        ];
        xmlJob::dispatch($data);
        $xmlDataString = $request->getContent();
    }
}
