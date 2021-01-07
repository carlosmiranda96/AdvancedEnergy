<?php

namespace App\Http\Controllers;

use App\Models\estadocivil;
use Illuminate\Http\Request;

class EstadocivilController extends Controller
{
    public function index()
    {
        $estadocivil = estadocivil::orderby('estadocivil')->paginate(5);
        return view('admin.estadocivil.lista',compact('estadocivil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estadocivil.create');
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
            'estadocivil' => 'required'
        ]);
        estadocivil::create([
            'estadocivil' => $request->estadocivil
        ]);
        return redirect()->route('estadocivil.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(estadocivil $estadocivil)
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
        $estadocivil = estadocivil::find($id);
        return view('admin.estadocivil.edit',compact('estadocivil'));
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
            'estadocivil' => 'required'
        ]);
        $estadocivil = estadocivil::find($id);
        $estadocivil->update($request->all());
        return redirect()->route('estadocivil.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estadocivil = estadocivil::find($id);
        $estadocivil->delete();
        return redirect()->route('estadocivil.index')->with('mensaje','Dato eliminado correctamente');
    }
}
