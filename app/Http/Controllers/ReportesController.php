<?php

namespace App\Http\Controllers;

use App\Http\Controllers\reportes\AsistenciaRPTController;
use App\Models\autorizacionusuarios;
use App\Models\modulos;
use App\Models\permisos;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function reportes($id)
    {
        $idusuario = session('user_id');
        $reporte = modulos::find($id);

        $titulo = "Reporte de ".$reporte->modulo;
        if ($id==60) {
            $parametro = app(AsistenciaRPTController::class)->parametros();
        }
        return view('reportes.reportes',compact('titulo','parametro'));
    }
    public function generarPDF(Request $request)
    {
        /*$reporte = permisos::find($request->idreporte);
        if(isset($reporte)){
            $ruta = $reporte->ruta;
            return redirect()->route($ruta.".pdf",$request->all());
        }else{
            return redirect()->route('reportes')->with('error','No se ha podido generar el documento');
        }*/
    }
}
