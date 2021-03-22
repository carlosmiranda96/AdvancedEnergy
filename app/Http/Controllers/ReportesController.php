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
        $excel = "AsistenciaRPTController.excel";
        return view('reportes.reportes',compact('titulo','parametro','excel'));
    }
}
