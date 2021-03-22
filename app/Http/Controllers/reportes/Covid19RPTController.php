<?php

namespace App\Http\Controllers\reportes;

use App\exports\AsistenciaExport;
use App\Http\Controllers\Controller;
use App\Models\formularios\covid\formua;
use App\Models\formularios\covid\formub;
use App\Models\formularios\covid\formuc;
use App\Models\empleados;
use Illuminate\Http\Request;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;

class Covid19RPTController extends Controller
{
    public function parametros()
    {
        //$empleados = empleados::where('estado',1)->orderby('nombre1')->get();
        $parametro=    '<div class="form-group">
                    <label>Seleccione tipo reporte</label>
                    <select class="form-control" name="idreporte" required>
                        <option value="">Seleccione</option><option value="1">Detalle</option><option value="2">Resumen</option>';
        $parametro=$parametro.'   </select>
                </div>';
        $parametro=$parametro.'<div class="form-group">
                <label>Desde</label>
                <input type="date" class="form-control" name="desde" required/>
              </div>
              <div class="form-group">
                <label>Hasta</label>
                <input type="date" class="form-control" name="hasta" required/>
               </div>
              ';
        return $parametro;
    }
    public function generarExcel(Request $request)
    {
        date_default_timezone_set('America/El_Salvador');
        $idreporte = $request->idreporte;
        $desde = $request->desde;
        $hasta = $request->hasta;

        $idreporte = 2;
        $desde = "2021-03-17";
        $hasta = "2021-03-18";

        if($idreporte==1){
            $columnas = array("FECHA","NOMBRE","DUI","GENERO","EMPRESA","OTRA EMPRESA","PROYECTO","TEMPERATURA","COMENTARIOS");
            $sintomas = formuc::orderby("id")->get();
            foreach($sintomas as $item2){
                array_push($columnas,$item2->sintoma."(".$item2->puntos." puntos)");
            }
            array_push($columnas,"PUNTUACIÓN");
            $data=array($columnas);

            $covid = formua::join("generos as b","formuas.idgenero","b.id")->select("formuas.*","b.genero")->where("fecha",">=",$desde)->where("fecha","<=",$hasta)->get();
            $contador = 0;
            foreach($covid as $item){
                $columna1 = array(
                    $item->fecha,
                    $item->nombrecompleto,
                    $item->dui,
                    $item->genero,
                    $item->empresa,
                    $item->otraempresa,
                    $item->proyecto,
                    $item->temperatura,
                    $item->comentarios
                );
                $puntuacion = 0;
                foreach($sintomas as $item2){
                    $respuestaf = formub::where("idformua",$item->id)->where("idformuc",$item2->id)->first();
                    if($respuestaf->respuesta=="SI"){
                        $puntosSintomas = $item2->puntos;
                    }else{
                        $puntosSintomas = 0;
                    }
                    $puntuacion = $puntuacion+$puntosSintomas;
                    array_push($columna1,$respuestaf->respuesta);
                }
                array_push($columna1,$puntuacion);
                array_push($data,$columna1);
                $contador++;
            }
            $export = new AsistenciaExport($data);
            return Excel::download($export,"Covid19.xlsx");
        }else{
            $columnas = array("ID","NOMBRE","DETALLES","PUNTUACIÓN","PERIODO");
            $data=array($columnas);
            $id = 1;
            $empleados = empleados::where("estado",1)->where("id","!=","codigo")->orderby("codigo")->get();
            $diainicio = date("d",strtotime($desde));
            $diafinal = date("d",strtotime($hasta));
            setlocale(LC_TIME, 'es_ES');
            $mes  = date("m",strtotime($hasta));
            if($mes == "01"){
                $mes = "Enero";
            }else if($mes == "02"){
                $mes = "Febrero";
            }else if($mes == "03"){
                $mes = "Marzo";
            }else if($mes == "04"){
                $mes = "Abril";
            }else if($mes == "05"){
                $mes = "Mayo";
            }else if($mes == "06"){
                $mes = "Junio";
            }else if($mes == "07"){
                $mes = "Julio";
            }else if($mes == "08"){
                $mes = "Agosto";
            }else if($mes == "09"){
                $mes = "Septiembre";
            }else if($mes == "10"){
                $mes = "Octubre";
            }else if($mes == "11"){
                $mes = "Noviembre";
            }else if($mes == "12"){
                $mes = "Diciembre";
            }
            $año = date("Y",strtotime($hasta));
            $periodo = "Semana del ".$diainicio." al ".$diafinal." de ".$mes." ".$año;
            foreach($empleados as $item)
            {
                
                $fila1 = array(
                    $id,
                    $item->nombreCompleto,
                    "",
                    "",
                    $periodo
                );
                array_push($data,$fila1);
                $id++;
            }

            $export = new AsistenciaExport($data);
            return Excel::download($export,"Covid19.xlsx");
        }
    }
}
