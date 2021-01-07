<?php

namespace App\Http\Controllers;

use App\Models\empleadoReferencia;
use App\Models\empleados;
use Illuminate\Http\Request;

class EmpleadoreferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $empleados = empleados::find($request->id);
        return view('rrhh.empleados.referencia.create',compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'nombre' => 'required',
            'contacto' => 'required'
        ]);
        empleadoreferencia::create($request->all());
        return redirect()->route('empleadoreferencia.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\empleadoreferencia  $empleadoreferencia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleados = empleados::find($id);
        $empleadoreferencia = empleadoreferencia::where('idempleado',$id)->paginate();
        return view('rrhh.empleados.referencia.show',compact('empleados','empleadoreferencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empleadoreferencia  $empleadoreferencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleadoreferencia = empleadoreferencia::find($id);
        $empleados = empleados::find($empleadoreferencia->idempleado);
        return view('rrhh.empleados.referencia.edit',compact('empleados','empleadoreferencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empleadoreferencia  $empleadoreferencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $empleadoreferencia = empleadoreferencia::find($id);
        $empleadoreferencia->update($request->all());
        return redirect()->route('empleadoreferencia.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empleadoreferencia  $empleadoreferencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleadoreferencia = empleadoreferencia::find($id);
        $idempleado = $empleadoreferencia->idempleado;
        $empleadoreferencia->delete();
        return redirect()->route('empleadoreferencia.show',$idempleado)->with('mensaje','Dato eliminado correctamente');
    }
}
