<?php

namespace App\Http\Controllers;

use App\Models\cargos;
use App\Models\config\empresa;
use App\Models\Departamento;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = cargos::leftJoin('departamentos','cargos.idDepartamento','=','departamentos.id')->select('cargos.*','departamentos.departamento')->paginate(5);
        return view('admin.cargos.lista',compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = empresa::all()->sortBy('nombreEmpresa');
        return view('admin.cargos.create',compact('empresas'));
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
            'cargo' => 'required',
            'idDepartamento' => 'integer|min:1'
        ]);
        cargos::create([
            'cargo' => $request->cargo,
            'idDepartamento' => $request->idDepartamento
        ]);
        return redirect()->route('cargos.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(cargos $cargos)
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
        $cargos = cargos::find($id);
        
        $empresas = empresa::all()->sortBy('nombreEmpresa');

        $idEmpresa = Departamento::find($cargos->idDepartamento)->idempresa;

        $departamentos = Departamento::where('idempresa',$idEmpresa)->get()->sortBy('departamento');
        return view('admin.cargos.edit',compact('cargos','departamentos','empresas','idEmpresa'));
    }

    public function getCargo(Request $request)
    {
        $cargos = cargos::orderby('cargo')
        ->join('departamentos as b','idDepartamento','b.id')
        ->select('cargos.*')
        ->where('b.idempresa',$request->idempresa)->get();
        echo json_encode($cargos);
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
            'cargo' => 'required'
        ]);
        $cargos = cargos::find($id);
        $cargos->update($request->all());

        return redirect()->route('cargos.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargos = cargos::find($id);
        $cargos->delete();
        return redirect()->route('cargos.index')->with('mensaje','Dato eliminado correctamente');
    }
}
