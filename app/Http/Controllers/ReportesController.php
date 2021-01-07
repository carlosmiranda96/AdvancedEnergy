<?php

namespace App\Http\Controllers;

use App\Models\autorizacionusuarios;
use App\Models\permisos;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function reportes()
    {
        $idusuario = session('user_id');
        $reportes = autorizacionusuarios::join('permisos','idpermiso','permisos.id')->select('permisos.*')->
        where('autorizacionusuarios.idusuario',$idusuario)->where('ruta','like','reportes.%')->get();
        return view('reportes.reportes',compact('reportes'));
    }
    public function parametros(Request $request)
    {
        $reporte = permisos::find($request->idreporte);
        if(isset($reporte)){
            $ruta = $reporte->ruta;
            return redirect()->route($ruta.".parametros",$request->idreporte);
        }else{
            echo 0;
        }
    }
    public function generarPDF(Request $request)
    {
        $reporte = permisos::find($request->idreporte);
        if(isset($reporte)){
            $ruta = $reporte->ruta;
            return redirect()->route($ruta.".pdf",$request->all());
        }else{
            return redirect()->route('reportes')->with('error','No se ha podido generar el documento');
        }
    }
}
