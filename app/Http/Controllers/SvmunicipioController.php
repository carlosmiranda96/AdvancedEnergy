<?php

namespace App\Http\Controllers;

use App\Models\svmunicipio;
use App\Models\svdepartamento;
use Illuminate\Http\Request;

class SvmunicipioController extends Controller
{
    public function index()
    {
        $svmunicipio = svmunicipio::join('svdepartamentos','iddepartamento','svdepartamentos.id')->select('svmunicipios.*','svdepartamentos.departamento')->orderby('svmunicipios.codigo')->paginate(5);
        return view('admin.svmunicipio.lista',compact('svmunicipio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = svdepartamento::orderby('codigo')->get();
        return view('admin.svmunicipio.create',compact('departamentos'));
    }
    public function getdepartamento(Request $request)
    {
       $svmunicipio = svmunicipio::orderby('codigo')->where('iddepartamento',$request->iddepartamento)->get();
       echo json_encode($svmunicipio);
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
            'iddepartamento' => 'required|integer|min:1',
            'codigo' => 'required|unique:svmunicipios',
            'municipio' => 'required'
        ]);
        svmunicipio::create([
            'iddepartamento' => $request->iddepartamento,
            'codigo' => $request->codigo,
            'municipio' => $request->municipio
        ]);
        return redirect()->route('svmunicipio.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(svmunicipio $svmunicipio)
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
        $departamentos = svdepartamento::orderby('codigo')->get();
        $svmunicipio = svmunicipio::find($id);
        return view('admin.svmunicipio.edit',compact('svmunicipio','departamentos'));
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
            'iddepartamento' => 'required|integer|min:1',
            'codigo' => 'required|unique:svmunicipios,codigo,'.$id.',id',
            'municipio' => 'required'
        ]);
        $svmunicipio = svmunicipio::find($id);
        $svmunicipio->update($request->all());
        return redirect()->route('svmunicipio.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $svmunicipio = svmunicipio::find($id);
        $svmunicipio->delete();
        return redirect()->route('svmunicipio.index')->with('mensaje','Dato eliminado correctamente');
    }
}
