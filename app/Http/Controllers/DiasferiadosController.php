<?php

namespace App\Http\Controllers;

use App\Models\diasFeriados;
use Illuminate\Http\Request;

class DiasferiadosController extends Controller
{
    public function index()
    {
        $diasFeriados = diasFeriados::paginate(5);
        return view('admin.diasFeriados.lista',compact('diasFeriados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.diasFeriados.create');
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
            'fecha' => 'required',
            'descripcion' => 'required'
        ]);
        diasFeriados::create([
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion
        ]);
        return redirect()->route('diasFeriados.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(diasFeriados $diasFeriados)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diasFeriados = diasFeriados::find($id);
        return view('admin.diasFeriados.edit',compact('diasFeriados'));
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
            'fecha' => 'required',
            'descripcion' => 'required'
        ]);
        $diasFeriados = diasFeriados::find($id);
        $diasFeriados->update($request->all());

        return redirect()->route('diasFeriados.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diasFeriados = diasFeriados::find($id);
        $diasFeriados->delete();
        return redirect()->route('diasFeriados.index')->with('mensaje','Dato eliminado correctamente');
    }
}
