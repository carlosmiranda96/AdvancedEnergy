<?php

namespace App\Http\Controllers;

use App\Models\dias;
use Illuminate\Http\Request;

class DiasController extends Controller
{
    public function index()
    {
        $dias = dias::paginate(5);
        return view('admin.dias.lista',compact('dias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dias.create');
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
            'dia' => 'required'
        ]);
        dias::create([
            'dia' => $request->dia
        ]);
        return redirect()->route('dias.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(dias $dias)
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
        $dias = dias::find($id);
        return view('admin.dias.edit',compact('dias'));
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
            'dia' => 'required'
        ]);
        $dias = dias::find($id);
        $dias->update($request->all());

        return redirect()->route('dias.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dias = dias::find($id);
        $dias->delete();
        return redirect()->route('dias.index')->with('mensaje','Dato eliminado correctamente');
    }
}
