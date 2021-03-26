<?php

namespace App\Http\Controllers\reportes;

use App\exports\AsistenciaExport;
use App\Http\Controllers\Controller;
use App\Models\formularios\solicitudempleo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SolicitudEmpleoRPTController extends Controller
{
    public function parametros()
    {
        /*$parametro='<div class="form-group">
                <label>Desde</label>
                <input type="date" class="form-control" name="desde" required/>
              </div>
              <div class="form-group">
                <label>Hasta</label>
                <input type="date" class="form-control" name="hasta" required/>
               </div>
              ';*/
        $parametro = "<h4>Se descargaran todos los registros hasta la fecha</h4>";
        return $parametro;
    }
    public function generarExcel(Request $request)
    {
        date_default_timezone_set('America/El_Salvador');
        $desde = $request->desde;
        $hasta = $request->hasta;

        $columnas = array("FECHA","NOMBRE","APELLIDO","DUI","FECHA NACIMIENTO","DIRECCION ACTUAL","TELEFONO","CELULAR","EMAIL","ASPIRACION SALARIAL","EDUCACION","PUESTO","EMPRESA","CARGO","FECHA INICIO","SALARIO","RESPONSABILIDADES","ES TRABAJO ACTUAL");
        $data=array($columnas);

        //$solicitud = solicitudempleo::where("created_at","<=",$hasta.' 24:00')->get();
        $solicitud = solicitudempleo::get();
        foreach($solicitud as $item){
            $columna1 = array(
                $item->created_at,
                $item->nombre,
                $item->apellido,
                $item->dui,
                $item->fechanacimiento,
                $item->direccionactual,
                $item->telefono,
                $item->celular,
                $item->email,
                $item->aspiracionsalarial,
                $item->educacion,
                $item->puesto,
                $item->Eempresa,
                $item->Ecargo,
                $item->Efechainicio,
                $item->Esalario,
                $item->Eresponsabilidades,
                $item->Etrabajoactual
            );
            array_push($data,$columna1);
        }
        $export = new AsistenciaExport($data);
        return Excel::download($export,"SolicitudesEmpleos.xlsx");
    }
}
