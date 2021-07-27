<?php

namespace App\Http\Controllers;

use App\Models\empleadoEmpresa;
use App\Models\empleados;
use App\Models\cargos;
use App\Models\config\empresa;
use App\Models\ubicacion;
use App\Models\grupohorario;
use Illuminate\Http\Request;

class EmpleadoempresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $empleados = empleados::find($request->id);
        $horario = grupohorario::orderby('nombre')->get();
        $empresas = empresa::orderby('nombreEmpresa')->get();
        return view('rrhh.empleados.empresa.create',compact('empleados','horario','empresas'));
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
            'idempresa' => 'required|integer|min:1',
            'idgrupohorario' => 'required|integer|min:1',
            'idcargo' => 'required|integer|min:1'
        ]);
        empleadoempresa::create($request->all());
        return redirect()->route('empleadoempresa.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\empleadoempresa  $empleadoempresa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleados = empleados::find($id);
        $empleadoempresa = empleadoempresa::join('cargos as a','empleado_empresas.idcargo','a.id')
        ->join('empresas as b','empleado_empresas.idempresa','b.id')
        ->join('grupohorarios as c','empleado_empresas.idgrupohorario','c.id')
        ->select('empleado_empresas.*','a.cargo','b.nombreEmpresa as empresa','c.nombre as horario')->where('idempleado',$id)
        ->paginate();
        return view('rrhh.empleados.empresa.show',compact('empleados','empleadoempresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empleadoempresa  $empleadoempresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleadoempresa = empleadoempresa::find($id);
        $empleados = empleados::find($empleadoempresa->idempleado);
        $cargo = cargos::orderby('cargo')
        ->join('departamentos as a','idDepartamento','a.id')
        ->select('cargos.*')
        ->where('a.idempresa',$empleadoempresa['idempresa'])
        ->get();
        $horario = grupohorario::orderby('nombre')->get();

        $empresas = empresa::orderby('nombreEmpresa')->get();
        return view('rrhh.empleados.empresa.edit',compact('empleados','empleadoempresa','cargo','horario','empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empleadoempresa  $empleadoempresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $empleadoempresa = empleadoempresa::find($id);
        $horasextras = 0;
        if(isset($request->horasextras)){
            $horasextras = $request->horasextras;
        }
        $empleadoempresa->idempleado = $request->idempleado;
        $empleadoempresa->idcargo = $request->idcargo;
        $empleadoempresa->idempresa = $request->idempresa;
        $empleadoempresa->idgrupohorario = $request->idgrupohorario;
        $empleadoempresa->salario = $request->salario;
        $empleadoempresa->horasextras = $horasextras;
        $empleadoempresa->save();
        return redirect()->route('empleadoempresa.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empleadoempresa  $empleadoempresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleadoempresa = empleadoempresa::find($id);
        $idempleado = $empleadoempresa->idempleado;
        $empleadoempresa->delete();
        return redirect()->route('empleadoempresa.show',$idempleado)->with('mensaje','Dato eliminado correctamente');
    }
}
