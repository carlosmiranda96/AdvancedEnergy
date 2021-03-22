<?php

namespace App\Http\Controllers;

use App\Models\marcacionesempleados;
use App\Models\empleadoUser;
use Illuminate\Http\Request;

class MarcacionesempleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.marcaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\marcacionesempleados  $marcacionesempleados
     * @return \Illuminate\Http\Response
     */
    public function show($idusuario)
    {
        $idusuario = session()->get('user_id');
        $empleadouser = empleadoUser::where('idusuario',$idusuario)->first();
        if(isset($empleadouser)){
            $idempleado = $empleadouser->idempleado;
        }else{
            $idempleado = 0;
        }
        $marcacionesempleados = marcacionesempleados::join('empleados','idempleado','empleados.id')->join('ubicacions','idubicacion','ubicacions.id')->select('marcacionesempleados.*','empleados.nombreCompleto as empleado','ubicacions.descripcion as ubicacion')->orderby('fecha','desc')->orderby('instante','desc')->where('idusuario',$idusuario)->orWhere('idempleado',$idempleado)->paginate(5);
        return view('general.marcaciones.show',compact('marcacionesempleados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\marcacionesempleados  $marcacionesempleados
     * @return \Illuminate\Http\Response
     */
    public function edit(marcacionesempleados $marcacionesempleados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\marcacionesempleados  $marcacionesempleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, marcacionesempleados $marcacionesempleados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\marcacionesempleados  $marcacionesempleados
     * @return \Illuminate\Http\Response
     */
    public function destroy(marcacionesempleados $marcacionesempleados)
    {
        //
    }
}
