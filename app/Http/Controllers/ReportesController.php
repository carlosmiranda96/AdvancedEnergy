<?php

namespace App\Http\Controllers;

use App\Http\Controllers\reportes\AsistenciaRPTController;
use App\Http\Controllers\reportes\Covid19RPTController;
use App\Http\Controllers\reportes\SolicitudEmpleoRPTController;
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
        switch ($id)
        {
            case 60:
                $parametro = app(AsistenciaRPTController::class)->parametros();
                $excel = "AsistenciaRPTController.excel";
            break;
            case 66:
                $parametro = app(Covid19RPTController::class)->parametros();
                $excel = "Covid19RPTController.excel";
            break;
            case 67:
                $parametro = app(SolicitudEmpleoRPTController::class)->parametros();
                $excel = "SolicitudEmpleoRPTController.excel";          
        }
        
        return view('reportes.reportes',compact('titulo','parametro','excel'));
    }
}
