<?php

namespace App\Http\Controllers;

use App\Models\genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {
        $genero = genero::orderby('genero')->paginate(5);
        return view('admin.genero.lista',compact('genero'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genero.create');
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
            'genero' => 'required'
        ]);
        genero::create([
            'genero' => $request->genero
        ]);
        return redirect()->route('genero.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(genero $genero)
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
        $genero = genero::find($id);
        return view('admin.genero.edit',compact('genero'));
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
            'genero' => 'required'
        ]);
        $genero = genero::find($id);
        $genero->update($request->all());
        return redirect()->route('genero.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genero = genero::find($id);
        $genero->delete();
        return redirect()->route('genero.index')->with('mensaje','Dato eliminado correctamente');
    }
}
