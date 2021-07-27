<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\syncappae;
use Illuminate\Http\Request;

class SyncappaeController extends Controller
{
    public $toquen = "dA2yDUp2tzs2ZdokZkM1";
    
    public function addsync(Request $request)
    {
        date_default_timezone_set('America/El_Salvador');
        $data = NULL;
        if($request->toquen==$this->toquen){
            $sync = new syncappae();
            $sync->key = $request->key;
            $sync->fecha = $request->fecha;
            $sync->hora = $request->hora;
            $sync->descripcion = $request->descripcion;
            $sync->save();
            $data['sync'][0]['respuesta'] = 1;
        }else{
            $data['sync'][0]['respuesta'] = 0;
        }
        echo json_encode($data);
    }
}
