<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\empleados;
use App\Models\equiposhistorial;
use App\Models\equipostrabajo;
use App\Models\marcacionesempleados;
use App\Models\rrhh\Carnet;
use App\Models\ubicacion;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public $toquen = "dA2yDUp2tzs2ZdokZkM1";
    public function ubicaciones(Request $request)
    {
        $data = NULL;
        if($request->toquen==$this->toquen){
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
        $data = NULL;
        if($request->toquen==$this->toquen){
            $empleados = empleados::join("carnets as b","empleados.id","b.idempleado")->select("empleados.id","b.id as idcarnet","b.codigo","empleados.nombreCompleto","empleados.foto","b.toquen")->get();
            $correlativo = 0;
            foreach($empleados as $item){
                $data['empleados'][$correlativo]['id'] = $item->id;
                $data['empleados'][$correlativo]['idcarnet'] = $item->idcarnet;
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
        $data = NULL;
        if($request->toquen==$this->toquen){
            $vehiculos = equipostrabajo::all();
            $correlativo = 0;
            foreach($vehiculos as $item){
                $data['vehiculos'][$correlativo]['id'] = $item->id;
                $data['vehiculos'][$correlativo]['codigo'] = $item->codigo;
                $data['vehiculos'][$correlativo]['placa'] = $item->placa;
                $data['vehiculos'][$correlativo]['tipo'] = $item->tipo;
                $correlativo++;
            }		
            if($correlativo==0){
                $data['vehiculos'][0]['id'] = 0;
                $data['vehiculos'][0]['codigo'] = 0;
                $data['vehiculos'][0]['placa'] = 0;
                $data['vehiculos'][0]['tipo'] = 0;
            }	
        }else{
            $data['vehiculos'][0]['id'] = 0;
            $data['vehiculos'][0]['codigo'] = 0;
            $data['vehiculos'][0]['placa'] = 0;
            $data['vehiculos'][0]['tipo'] = 0;
        }
        echo json_encode($data);
    }
    public function getMarcaciones($idusuario,Request $request){
        date_default_timezone_set('America/El_Salvador');
        $fecha = date("Y-m-d");
        $data = NULL;
        if($request->toquen==$this->toquen){
            $marcaciones = marcacionesempleados::join("empleados as b","marcacionesempleados.idempleado","b.id")->join("ubicacions as c","marcacionesempleados.idubicacion","c.id")->
            select("c.descripcion","b.codigo","marcacionesempleados.fecha","marcacionesempleados.instante","marcacionesempleados.tipo")->where("marcacionesempleados.fecha",$fecha)->where("marcacionesempleados.idusuario",$idusuario)->orderby("marcacionesempleados.instante","desc")->get();
            $correlativo = 0;
            foreach($marcaciones as $item){
                $data['marcacion'][$correlativo]['ubicacion'] = $item->descripcion;
                $data['marcacion'][$correlativo]['codigoempleado'] = $item->codigo;
                $data['marcacion'][$correlativo]['fecha'] = $item->fecha;
                $data['marcacion'][$correlativo]['hora'] = $item->instante;
                $data['marcacion'][$correlativo]['tipo'] = $item->tipo;
                $correlativo++;
            }		
            if($correlativo==0){
                $data['marcacion'][0]['ubicacion'] = "0";
                $data['marcacion'][0]['codigoempleado'] = "0";
                $data['marcacion'][0]['fecha'] = "0";
                $data['marcacion'][0]['hora'] = "0";
                $data['marcacion'][0]['tipo'] = "0";
            }	
        }else{
            $data['marcacion'][0]['ubicacion'] = "0";
            $data['marcacion'][0]['codigoempleado'] = "0";
            $data['marcacion'][0]['fecha'] = "0";
            $data['marcacion'][0]['hora'] = "0";
            $data['marcacion'][0]['tipo'] = "0";
        }
        echo json_encode($data);
    }
    public function addMarcacion(Request $request){
        date_default_timezone_set('America/El_Salvador');
        $data = NULL;
        if($request->toquen==$this->toquen){
            $existemarcacion = marcacionesempleados::where("idempleado",$request->idempleado)->where("idusuario",$request->idusuario)->where("fecha",$request->fecha)->where("instante",$request->hora)->where("idubicacion",$request->idubicacion)->first();
            if(isset($existemarcacion->id)){
                $data['marcacion'][0]['respuesta'] = 1;
            }else{
                $marcacion = new marcacionesempleados();
                if(isset($request->idempleado)){
                    $marcacion->idempleado = $request->idempleado;
                    $marcacion->idusuario = $request->idusuario;
                    $marcacion->tipo = $request->tipo;
                    $marcacion->fecha = $request->fecha;
                    $marcacion->instante = $request->hora;
                    $marcacion->idubicacion = $request->idubicacion;
                    $marcacion->latitud = $request->latitud;
                    $marcacion->longitud = $request->longitud;
                    $marcacion->save();
                    $data['marcacion'][0]['respuesta'] = 1;
                }else{
                    $data['marcacion'][0]['respuesta'] = 0;
                }
            }
        }else{
            $data['marcacion'][0]['respuesta'] = 0;
        }
        echo json_encode($data);
    }

    public function getVehiculos(Request $request)
    {
        $data = NULL;
        if($request->toquen==$this->toquen){
            $vehiculos = equiposhistorial::join('empleados as b','equiposhistorials.idempleado','b.id')->join('equipostrabajos as c','equiposhistorials.idequipotrabajo','c.id')
            ->select('equiposhistorials.*','b.codigo','b.nombrecompleto','c.codigo as codigovehiculo','c.placa')->get();
            $correlativo = 0;
            foreach($vehiculos as $item){
                $data['controlvehiculo'][$correlativo]['fecha'] = date("Y-m-d",strtotime($item->instante));
                $data['controlvehiculo'][$correlativo]['hora'] = date("H:i:s",strtotime($item->instante));
                $data['controlvehiculo'][$correlativo]['idvehiculo'] = $item->idequipotrabajo;
                $data['controlvehiculo'][$correlativo]['codigoequipo'] = $item->codigovehiculo;
                $data['controlvehiculo'][$correlativo]['idempleado'] = $item->idempleado;
                $data['controlvehiculo'][$correlativo]['nombre'] = $item->nombrecompleto;
                $data['controlvehiculo'][$correlativo]['kilometraje'] = $item->kilometraje;
                $data['controlvehiculo'][$correlativo]['combustible'] = $item->combustible;
                $data['controlvehiculo'][$correlativo]['extinguidor'] = $item->extinguidor;
                $data['controlvehiculo'][$correlativo]['botiquin'] = $item->botiquin;
                $data['controlvehiculo'][$correlativo]['equiposeguridad'] = $item->equiposeguridad;
                $data['controlvehiculo'][$correlativo]['observaciones'] = $item->observaciones;
                $data['controlvehiculo'][$correlativo]['idusuario'] = $item->idusuario;
                $data['controlvehiculo'][$correlativo]['latitud'] = $item->laitud;
                $data['controlvehiculo'][$correlativo]['longitud'] = $item->longitud;
                $data['controlvehiculo'][$correlativo]['uso'] = $item->uso;
                $data['controlvehiculo'][$correlativo]['proyecto'] = $item->proyecto;
                $correlativo++;
            }		
            if($correlativo==0){
                $data['controlvehiculo'][0]['fecha'] = 0;
                $data['controlvehiculo'][0]['hora'] = 0;
                $data['controlvehiculo'][0]['idvehiculo'] = 0;
                $data['controlvehiculo'][0]['codigoequipo'] = 0;
                $data['controlvehiculo'][0]['idempleado'] = 0;
                $data['controlvehiculo'][0]['nombre'] = 0;
                $data['controlvehiculo'][0]['kilometraje'] = 0;
                $data['controlvehiculo'][0]['combustible'] = 0;
                $data['controlvehiculo'][0]['extinguidor'] = 0;
                $data['controlvehiculo'][0]['botiquin'] = 0;
                $data['controlvehiculo'][0]['equiposeguridad'] = 0;
                $data['controlvehiculo'][0]['observaciones'] = 0;
                $data['controlvehiculo'][0]['idusuario'] = 0;
                $data['controlvehiculo'][0]['latitud'] = 0;
                $data['controlvehiculo'][0]['longitud'] = 0;
                $data['controlvehiculo'][0]['uso'] = 0;
                $data['controlvehiculo'][0]['proyecto'] = 0;
            }	
        }else{
            $data['controlvehiculo'][0]['fecha'] = 0;
                $data['controlvehiculo'][0]['hora'] = 0;
                $data['controlvehiculo'][0]['idvehiculo'] = 0;
                $data['controlvehiculo'][0]['codigoequipo'] = 0;
                $data['controlvehiculo'][0]['idempleado'] = 0;
                $data['controlvehiculo'][0]['nombre'] = 0;
                $data['controlvehiculo'][0]['kilometraje'] = 0;
                $data['controlvehiculo'][0]['combustible'] = 0;
                $data['controlvehiculo'][0]['extinguidor'] = 0;
                $data['controlvehiculo'][0]['botiquin'] = 0;
                $data['controlvehiculo'][0]['equiposeguridad'] = 0;
                $data['controlvehiculo'][0]['observaciones'] = 0;
                $data['controlvehiculo'][0]['idusuario'] = 0;
                $data['controlvehiculo'][0]['latitud'] = 0;
                $data['controlvehiculo'][0]['longitud'] = 0;
                $data['controlvehiculo'][0]['uso'] = 0;
                $data['controlvehiculo'][0]['proyecto'] = 0;
        }
        echo json_encode($data);
    }
    public function addControlVehiculos(Request $request)
    {
        $data = NULL;
        if($request->toquen==$this->toquen){
            $controlvehiculo = new equiposhistorial();
            if(isset($request->idempleado)){
                $controlvehiculo->instante = $request->fecha.' '.$request->hora;
                $controlvehiculo->idequipotrabajo = $request->idvehiculo;
                $controlvehiculo->idempleado = $request->idempleado;
                $controlvehiculo->idusuario = $request->idusuario;
                $controlvehiculo->latitud = $request->latitud;
                $controlvehiculo->longitud = $request->longitud;
                $controlvehiculo->save();
                $data['vehiculos'][0]['respuesta'] = 1;
            }else{
                $data['vehiculos'][0]['respuesta'] = 0;
            }
        }else{
            $data['vehiculos'][0]['respuesta'] = 0;
        }
        echo json_encode($data);
    }
    public function ultimamarcacion(Request $request)
    {
        $data = NULL;
        if($request->toquen==$this->toquen){
            date_default_timezone_set('America/El_Salvador');
            $dia = getdate();
            $fecha = date("Y-m-d");
            $marcacion = marcacionesempleados::where('idempleado',$request->idempleado)->where('fecha',$fecha)->orderby('instante','desc')->first();
            if($marcacion){
                $data['marcacion'][0]['tipo'] = $marcacion->tipo;
            }else{
                $data['marcacion'][0]['tipo'] = 0;
            }
        }else{
            $data['marcacion'][0]['tipo'] = 0;
        }
        echo json_encode($data);
    }
}
