<?php

namespace App\Http\Controllers;

use App\Models\pais;
use App\Models\svdepartamento;
use Illuminate\Http\Request;

class SvdepartamentoController extends Controller
{
    public function index()
    {
        $svdepartamento = svdepartamento::join('pais','idpais','pais.id')->select('svdepartamentos.*','pais')->orderby('codigo')->paginate(5);
        return view('admin.svdepartamento.lista',compact('svdepartamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pais = pais::orderby('pais')->get();
        return view('admin.svdepartamento.create',compact('pais'));
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
            'idpais' => 'required|integer|min:1',
            'codigo' => 'required',
            'departamento' => 'required'
        ]);
        svdepartamento::create([
            'idpais' => $request->idpais,
            'codigo' => $request->codigo,
            'departamento' => $request->departamento
        ]);
        return redirect()->route('svdepartamento.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(svdepartamento $svdepartamento)
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
        $svdepartamento = svdepartamento::find($id);
        $pais = pais::orderby('pais')->get();
        return view('admin.svdepartamento.edit',compact('svdepartamento','pais'));
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
            'idpais' => 'required|integer|min:1',
            'codigo' => 'required',
            'departamento' => 'required'
        ]);
        $svdepartamento = svdepartamento::find($id);
        $svdepartamento->update($request->all());
        return redirect()->route('svdepartamento.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $svdepartamento = svdepartamento::find($id);
        $svdepartamento->delete();
        return redirect()->route('svdepartamento.index')->with('mensaje','Dato eliminado correctamente');
    }
}
