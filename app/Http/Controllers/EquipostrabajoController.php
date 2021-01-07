<?php

namespace App\Http\Controllers;

use App\Models\equipostrabajo;
use Illuminate\Http\Request;

class EquipostrabajoController extends Controller
{
    public function index()
    {
        $equipostrabajo = equipostrabajo::orderby('codigo','desc')->paginate(5);
        return view('admin.equipos.lista',compact('equipostrabajo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.equipos.create');
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
            'codigo' => 'required|unique:equipostrabajos',
            'placa' => 'required',
            'marca' => 'required'
        ]);
        equipostrabajo::create([
            'codigo' => $request->codigo,
            'placa' => $request->placa,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'año' => $request->año,
            'descripcion' => $request->descripcion
        ]);
        return redirect()->route('equipos.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipostrabajo = equipostrabajo::find($id);
        return view('admin.equipos.show',compact('equipostrabajo'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipostrabajo = equipostrabajo::find($id);
        return view('admin.equipos.edit',compact('equipostrabajo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'codigo' => 'required',
            'placa' => 'required',
            'marca' => 'required'
        ]);
        $equipostrabajo = equipostrabajo::find($id);
        $equipostrabajo->update($request->all());
        return redirect()->route('equipos.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipostrabajo = equipostrabajo::find($id);
        $equipostrabajo->delete();
        return redirect()->route('equipos.index')->with('mensaje','Dato eliminado correctamente');
    }
}
