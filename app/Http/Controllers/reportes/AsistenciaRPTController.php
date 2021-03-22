<?php

namespace App\Http\Controllers\reportes;

use App\exports\AsistenciaExport;
use App\Http\Controllers\Controller;
use App\Models\empleados;
use App\Models\marcacionesempleados;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AsistenciaRPTController extends Controller
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

        if($idreporte==1){
            $data=array(
                array("FECHA","CODIGO","NOMBRE","ENTRADA","SALIDA","HORAS","UBICACION","USUARIO")
            );

            $date1 = new DateTime($desde);
            $date2 = new DateTime($hasta);
            $diff = $date1->diff($date2);

            $fechaactual = date("Y-m-d",strtotime($desde));
            for($i = 0;$i<$diff->days+1;$i++){
                $empleados = empleados::where("estado",1)->where("id","!=","codigo")->orderby("codigo")->get();
                foreach($empleados as $item)
                {
                    $marcacion = marcacionesempleados::join("ubicacions as b","marcacionesempleados.idubicacion","b.id")->join("users as c","idusuario","c.id")->
                    select("marcacionesempleados.fecha","marcacionesempleados.instante","b.descripcion as ubicacion","c.name as usuario")->
                    where("marcacionesempleados.idempleado",$item->id)->where("marcacionesempleados.tipo","Entrada")->where("marcacionesempleados.fecha",$fechaactual)->get();
                    $contador = 0;
                    foreach($marcacion as $asistencia){
                        $marcacionSalida = marcacionesempleados::where("idempleado",$item->id)->where("tipo","Salida")->where("fecha",$asistencia->fecha)->where("instante",">",$asistencia->instante)
                        ->orderby("fecha")->orderby("instante")->first();
                        if(isset($marcacionSalida->instante)){
                            $horaSalida = $marcacionSalida->instante;
                        }else{
                            $horaSalida = "";
                        }
                        $horastrabajadas = 0;
                        if($horaSalida!=""){
                            //$horastrabajadas = strtotime($horaSalida)-strtotime($asistencia->instante);

                            $horaInicio = new DateTime($asistencia->instante);
                            $horaTermino = new DateTime($horaSalida);
                            $interval = $horaInicio->diff($horaTermino);
                            $horas = $interval->format('%H')*60;
                            $minutos = $interval->format('%i');
                            $horastrabajadas = number_format(($horas+$minutos)/60,2);
                        }
                        array_push($data, array(
                            $asistencia->fecha,
                            $item->codigo,
                            $item->nombreCompleto,
                            $asistencia->instante,
                            $horaSalida,
                            $horastrabajadas,
                            $asistencia->ubicacion,
                            $asistencia->usuario));
                        $contador++;
                    }
                    if($contador==0){
                        array_push($data, array(
                            $fechaactual,
                            $item->codigo,
                            $item->nombreCompleto,
                            "",
                            "",
                            "",
                            "",
                            ""));
                    }
                }

                $fechaactual = date("Y-m-d",strtotime($fechaactual."+ 1 days"));
            }
            $export = new AsistenciaExport($data);
        
            return Excel::download($export,"asistencia.xlsx");
        }else{
            $filas = array("CODIGO","NOMBRE");

            $date1 = new DateTime($desde);
            $date2 = new DateTime($hasta);
            $diff = $date1->diff($date2);
            $fechaactual = date("Y-m-d",strtotime($desde));
            for($i = 0;$i<$diff->days+1;$i++){
                //array_push($filas,"");
                array_push($filas,date("d",strtotime($fechaactual)));
                $fechaactual = date("Y-m-d",strtotime($fechaactual."+ 1 days"));
            }
            $data=array($filas);

            $empleados = empleados::where("estado",1)->where("id","!=","codigo")->orderby("codigo")->get();
            foreach($empleados as $item)
            {
                $fila1 = array(
                    $item->codigo,
                    $item->nombreCompleto);

                $fechaactual = date("Y-m-d",strtotime($desde));
                for($i = 0;$i<$diff->days+1;$i++){
                    $asistencia = marcacionesempleados::join("ubicacions as b","marcacionesempleados.idubicacion","b.id")->select("b.codigo")->where('idempleado',$item->id)->where("fecha",$fechaactual)->first();
                    if($asistencia){
                        //array_push($fila1,"");
                        array_push($fila1,$asistencia->codigo);
                    }else{
                        //array_push($fila1,"");
                        array_push($fila1,"");
                    }
                    $fechaactual = date("Y-m-d",strtotime($fechaactual."+ 1 days"));
                }
                array_push($data,$fila1);
            }
            $export = new AsistenciaExport($data);
            return Excel::download($export,"asistencia.xlsx");
        }
    }
}
