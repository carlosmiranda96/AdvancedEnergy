<?php

namespace App\Http\Controllers\reportes;

use App\Exports\AsistenciaExport;
use App\Http\Controllers\Controller;
use App\Models\equiposhistorial;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ControlVehiculosRPTController extends Controller
{
    public function parametros()
    {
        $parametro='<div class="form-group">
                <label>Desde</label>
                <input type="date" class="form-control" name="desde" required/>
              </div>
              <div class="form-group">
                <label>Hasta</label>
                <input type="date" class="form-control" name="hasta" required/>
               </div>
              ';
        //$parametro = "<h4>Se descargaran todos los registros hasta la fecha</h4>";
        return $parametro;
    }
    public function generarExcel(Request $request)
    {
        date_default_timezone_set('America/El_Salvador');
        $desde = $request->desde;
        $hasta = $request->hasta;

        $columnas = array("Fecha","Hora","Equipo","Placa","Codigo Carnet","Nombre","kilometraje","Combustible","Uso","Proyecto","Herramienta","observaciones");
        $data=array($columnas);
        
        $controlvehiculo = equiposhistorial::join("empleados as b","equiposhistorials.idempleado","b.id")
        ->join("equipostrabajos as c","equiposhistorials.idequipotrabajo","c.id")
        ->select("equiposhistorials.*","b.codigo as carnet","b.nombreCompleto","c.codigo as equipo","c.placa")
        ->where("instante",">=",$desde." 00:00")
        ->where("instante","<=",$hasta." 23:59")->get();
        foreach($controlvehiculo as $item)
        {

            array_push($data,array(
                date("Y-m-d",strtotime($item->instante)),
                date("h:i",strtotime($item->instante)),
                $item->equipo,
                $item->placa,
                $item->carnet,
                $item->nombreCompleto,
                $item->kilometraje,
                $item->combustible,
                $item->uso,
                $item->proyecto,
                $item->herramienta,
                $item->observaciones
            ));
        }

        $export = new AsistenciaExport($data);
        return Excel::download($export,"Controlvehiculos.xlsx");
    }
}
