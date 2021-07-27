<?php

namespace App\Http\Controllers;

use App\Models\config\empresa;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        //$departamento = departamento::leftJoin('departamentos as b','departamentos.dependencia','=','b.id')
        //->Join('empresas as c','departamentos.idempresa','=','c.id')
        //->select('departamentos.*','b.departamento as nombredependencia')
        //->orderby('departamentos.nivel')

        $departamento = Departamento::leftJoin('empresas as b','departamentos.idempresa','b.id')
        ->select('departamentos.*','b.nombreEmpresa')
        ->paginate(5);
        return view('admin.departamento.lista',compact('departamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = empresa::all()->sortBy('nombreEmpresa');
        //$departamento = departamento::all()->sortBy('departamento');
        return view('admin.departamento.create',compact('empresa'));
    }
    public function getDepartamento(Request $request)
    {
        $departamento = Departamento::orderby('departamento')->where('idempresa',$request->idempresa)->get();
        echo json_encode($departamento);
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
            'idempresa' => 'required',
            'departamento' => 'required',
            'nivel' => 'required',
            'dependencia' => 'required'
        ]);
        departamento::create([
            'idempresa' => $request->idempresa,
            'departamento' => $request->departamento,
            'nivel' => $request->nivel,
            'dependencia' => $request->dependencia
        ]);
        return redirect()->route('departamento.index')->with('mensaje','Datos guardados correctamente '.$request->idempresa);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(departamento $departamento)
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
        $departamento = departamento::find($id);
        

        $empresa = empresa::find($departamento->idempresa);
        $empresas = empresa::all()->sortBy('nombreEmpresa');

        $departamentos = departamento::where('idempresa',$empresa->id)->get()->sortBy('departamento');
        return view('admin.departamento.edit',compact('departamento','departamentos','empresas','empresa'));
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
            'idempresa' => 'required',
            'departamento' => 'required',
            'nivel' => 'required',
            'dependencia' => 'required'
        ]);
        $departamento = departamento::find($id);
        $departamento->update($request->all());
        
        return redirect()->route('departamento.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento = departamento::find($id);
        $departamento->delete();
        return redirect()->route('departamento.index')->with('mensaje','Dato eliminado correctamente');
    }
}
