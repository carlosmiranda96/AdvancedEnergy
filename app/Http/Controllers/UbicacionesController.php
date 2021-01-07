<?php

namespace App\Http\Controllers;

use App\Models\ubicacion;
use Illuminate\Http\Request;

class UbicacionesController extends Controller
{
    public function index()
    {
        $ubicacion = ubicacion::paginate(5);
        return view('admin.ubicacion.lista',compact('ubicacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ubicacion.create');
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
            'codigo' => 'required',
            'descripcion' => 'required',
            'longitud' => 'required',
            'latitud' => 'required'
        ]);
        ubicacion::create([
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud
        ]);
        return redirect()->route('ubicacion.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ubicacion = ubicacion::find($id);
        return view('admin.ubicacion.show',compact('ubicacion'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ubicacion = ubicacion::find($id);
        return view('admin.ubicacion.edit',compact('ubicacion'));
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
            'descripcion' => 'required',
            'latitud' => 'required',
            'longitud' => 'required'
        ]);
        $ubicacion = ubicacion::find($id);
        $ubicacion->update($request->all());

        return redirect()->route('ubicacion.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ubicacion = ubicacion::find($id);
        $ubicacion->delete();
        return redirect()->route('ubicacion.index')->with('mensaje','Dato eliminado correctamente');
    }
}
