<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use App\Models\empleados;
use App\Models\marcacionesempleados;
use Illuminate\Http\Request;

class AsistenciaRPTController extends Controller
{
    public function parametros()
    {
        $empleados = empleados::where('estado',1)->orderby('nombre1')->get();
        $parametro=    '<div class="form-group">
                    <label>Seleccione empleado</label>
                    <select class="form-control" name="idempleado" required>
                        <option value="0">Todos</option>';
                        foreach($empleados as $item){
                        echo '<option value="'.$item->id.'">'.$item->nombre1.' '.$item->apellido1.' '.$item->codigo.'</option>';
                        }
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
    public function generarPDF(Request $request)
    {
        $idreporte = $request->idreporte;
        $idempleado = $request->idempleado;
        $desde = $request->desde;
        $hasta = $request->hasta;

        if($idempleado==0){
            $asistencia = marcacionesempleados::join('empleados as a','idempleado','a.id')->join('ubicacions as b','idubicacion','b.id')
            ->select('marcacionesempleados.*','a.nombrecompleto as nombre','b.codigo as ubicacion')->whereBetween('instante',[$desde,$hasta.' 23:59'])->orderby('idempleado')->orderby('tipo')->get();
        }else{
            $asistencia = marcacionesempleados::join('empleados as a','idempleado','a.id')->join('ubicacions as b','idubicacion','b.id')
            ->select('marcacionesempleados.*','a.nombrecompleto as nombre','b.codigo as ubicacion')->whereBetween('instante',[$desde,$hasta.' 23:59'])->where('idempleado',$idempleado)->orderby('idempleado')->orderby('tipo')->get();
        }
        return view('reportes.asistenteRPT',compact('asistencia','desde','hasta'));

        /*$pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'landscape');
        $pdf->loadView('reportes.asistenteRPT',compact('asistencia','desde','hasta'));
        return $pdf->stream('asistencia.pdf');*/
    }
}
