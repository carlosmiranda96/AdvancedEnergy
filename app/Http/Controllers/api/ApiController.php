<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\empleados;
use App\Models\equipostrabajo;
use App\Models\ubicacion;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public $toquen = "dA2yDUp2tzs2ZdokZkM1";
    public function ubicaciones(Request $request)
    {
        if($request->toquen==$this->toquen){
            $data = NULL;
            $ubicaciones = ubicacion::all();
            $correlativo = 0;
            foreach($ubicaciones as $item){
                $data['ubicaciones'][$correlativo]['id'] = $item->id;
                $data['ubicaciones'][$correlativo]['descripcion'] = $item->descripcion;
                $data['ubicaciones'][$correlativo]['latitud'] = $item->latitud;
                $data['ubicaciones'][$correlativo]['longitud'] = $item->longitud;
                $correlativo++;
            }
            if($correlativo==0){
                $data['ubicaciones'][0]['id'] = 0;
                $data['ubicaciones'][0]['descripcion'] = "No Autorizado";
                $data['ubicaciones'][0]['latitud'] = 0;
                $data['ubicaciones'][0]['longitud'] = 0;
            }	
        }else{
            $data['ubicaciones'][0]['id'] = 0;
            $data['ubicaciones'][0]['descripcion'] = "No Autorizado";
            $data['ubicaciones'][0]['latitud'] = 0;
            $data['ubicaciones'][0]['longitud'] = 0;
        }
        echo json_encode($data);
    }
    public function empleados(Request $request)
    {
        if($request->toquen==$this->toquen){
            $data = NULL;
            $empleados = empleados::all();
            $correlativo = 0;
            foreach($empleados as $item){
                $data['empleados'][$correlativo]['id'] = $item->id;
                $data['empleados'][$correlativo]['idcarnet'] = $item->id;
                $data['empleados'][$correlativo]['codigocarnet'] = $item->codigo;
                $data['empleados'][$correlativo]['nombre'] = $item->nombreCompleto;
                $data['empleados'][$correlativo]['foto'] = $item->foto;
                $data['empleados'][$correlativo]['toquen'] = $item->toquen;
                $correlativo++;
            }
            if($correlativo==0){
                $data['empleados'][0]['id'] = 0;
                $data['empleados'][0]['idcarnet'] = 0;
                $data['empleados'][0]['codigocarnet'] = 0;
                $data['empleados'][0]['nombre'] = 0;
                $data['empleados'][0]['foto'] = 0;
                $data['empleados'][0]['toquen'] = 0;
            }
        }else{
            $data['empleados'][0]['id'] = 0;
            $data['empleados'][0]['idcarnet'] = 0;
            $data['empleados'][0]['codigocarnet'] = 0;
            $data['empleados'][0]['nombre'] = 0;
            $data['empleados'][0]['foto'] = 0;
            $data['empleados'][0]['toquen'] = 0;
        }
        echo json_encode($data);
    }
    public function vehiculos(Request $request)
    {
        if($request->toquen==$this->toquen){
            $data = NULL;
            $vehiculos = equipostrabajo::all();
            $correlativo = 0;
            foreach($vehiculos as $item){
                $data['vehiculos'][$correlativo]['id'] = $item->id;
                $data['vehiculos'][$correlativo]['codigo'] = $item->codigo;
                $data['vehiculos'][$correlativo]['placa'] = $item->placa;
                $correlativo++;
            }		
            if($correlativo==0){
                $data['vehiculos'][0]['id'] = 0;
                $data['vehiculos'][0]['codigo'] = 0;
                $data['vehiculos'][0]['placa'] = 0;
            }	
        }else{
            $data['vehiculos'][0]['id'] = 0;
            $data['vehiculos'][0]['codigo'] = 0;
            $data['vehiculos'][0]['placa'] = 0;
        }
        echo json_encode($data);
    }
}
