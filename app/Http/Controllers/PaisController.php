<?php

namespace App\Http\Controllers;

use App\Models\pais;
use App\Models\svdepartamento;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        $pais = pais::orderby('pais')->paginate(5);
        return view('admin.pais.lista',compact('pais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pais.create');
    }
    public function getDepartamento(Request $request)
    {
        $svdepartamento = svdepartamento::orderby('codigo')->where('idpais',$request->idpais)->get();
        echo json_encode($svdepartamento);
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
            'pais' => 'required'
        ]);
        pais::create([
            'pais' => $request->pais,
        ]);
        return redirect()->route('pais.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(pais $pais)
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
        $pais = pais::find($id);
        return view('admin.pais.edit',compact('pais'));
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
            'pais' => 'required'
        ]);
        $pais = pais::find($id);
        $pais->update($request->all());
        return redirect()->route('pais.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pais = pais::find($id);
        $pais->delete();
        return redirect()->route('pais.index')->with('mensaje','Dato eliminado correctamente');
    }
}
