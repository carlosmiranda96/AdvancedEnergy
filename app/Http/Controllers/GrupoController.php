<?php

namespace App\Http\Controllers;

use App\Models\grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function __construct()
    {
        //return redirect()->route('login');
    }
    public function index()
    {
        $grupo = grupo::paginate(5);
        return view('admin.grupo.lista',compact('grupo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.grupo.create');
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
            'grupo' => 'required'
        ]);
        $grupo = new grupo;
        $grupo->grupo = $request->grupo;
        $grupo->save();
        return redirect()->route('grupo.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(grupo $grupo)
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
        $grupo = grupo::find($id);
        return view('admin.grupo.edit',compact('grupo'));
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
            'grupo' => 'required'
        ]);
        $grupo = grupo::find($id);
        $grupo->grupo = $request->grupo;
        $grupo->save();
        return redirect()->route('grupo.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = grupo::find($id);
        $grupo->delete();
        return redirect()->route('grupo.index')->with('mensaje','Dato eliminado correctamente');
    }
}
