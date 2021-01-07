<?php

namespace App\Http\Controllers;

use App\Models\tipodocumento;
use Illuminate\Http\Request;

class TipodocumentoController extends Controller
{
    public function index()
    {
        $tipodocumento = tipodocumento::orderby('tipodocumento')->paginate(5);
        return view('admin.tipodocumento.lista',compact('tipodocumento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipodocumento.create');
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
            'tipodocumento' => 'required'
        ]);
        tipodocumento::create([
            'tipodocumento' => $request->tipodocumento
        ]);
        return redirect()->route('tipodocumento.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(tipodocumento $tipodocumento)
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
        $tipodocumento = tipodocumento::find($id);
        return view('admin.tipodocumento.edit',compact('tipodocumento'));
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
            'tipodocumento' => 'required'
        ]);
        $tipodocumento = tipodocumento::find($id);
        $tipodocumento->update($request->all());
        return redirect()->route('tipodocumento.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipodocumento = tipodocumento::find($id);
        $tipodocumento->delete();
        return redirect()->route('tipodocumento.index')->with('mensaje','Dato eliminado correctamente');
    }
}
