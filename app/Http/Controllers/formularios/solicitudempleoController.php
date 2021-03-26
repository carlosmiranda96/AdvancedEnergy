<?php

namespace App\Http\Controllers\formularios;

use App\Http\Controllers\Controller;
use App\Models\formularios\solicitudempleo as FormulariosSolicitudempleo;
use Illuminate\Http\Request;

class solicitudempleoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("form.solicitudempleo");
    }
    public function guardar(Request $request)
    {
        date_default_timezone_set('America/El_Salvador');
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dui' => 'required',
            'fechanacimiento' => 'required',
            'direccionactual' => 'required',
            'telefono' => 'required',
            'celular' => 'required',
            'email' => 'required'
        ]);
        $solicitud = new FormulariosSolicitudempleo();
        $solicitud->nombre = $request->nombre;
        $solicitud->apellido = $request->apellido;
        $solicitud->dui = $request->dui;
        $solicitud->fechanacimiento = $request->fechanacimiento;
        $solicitud->direccionactual = $request->direccionactual;
        $solicitud->telefono = $request->telefono;
        $solicitud->celular = $request->celular;
        $solicitud->email = $request->email;
        $solicitud->aspiracionsalarial = $request->aspiracionsalarial;
        $solicitud->educacion = $request->educacion;
        $solicitud->puesto = $request->puesto;
        $solicitud->Eempresa = $request->Eempresa;
        $solicitud->Ecargo = $request->Ecargo;
        $solicitud->Efechainicio = $request->Efechainicio;
        $solicitud->Esalario = $request->Esalario;
        $solicitud->Eresponsabilidades = $request->Eresponsabilidades;
        $solicitud->Etrabajoactual = $request->Etrabajoactual;
        $solicitud->save();
        return redirect()->route('form.solicitudempleo')->with('mensaje','Solicitud enviada correctamente');
    }
}
