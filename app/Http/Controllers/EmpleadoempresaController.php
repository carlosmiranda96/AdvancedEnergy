<?php

namespace App\Http\Controllers;

use App\Models\empleadoEmpresa;
use App\Models\empleados;
use App\Models\cargos;
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
        $cargo = cargos::orderby('cargo')->get();
        $horario = grupohorario::orderby('nombre')->get();
        $ubicacion = ubicacion::orderby('descripcion')->get();
        return view('rrhh.empleados.empresa.create',compact('empleados','cargo','horario','ubicacion'));
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
            'idubicacion' => 'required|integer|min:1',
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
        $empleadoempresa = empleadoempresa::join('cargos as a','idcargo','a.id')->join('ubicacions as b','idubicacion','b.id')->join('grupohorarios as c','idgrupohorario','c.id')->select('empleado_empresas.*','a.cargo','b.descripcion as ubicacion','c.nombre as horario')->where('idempleado',$id)->paginate();
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
        $cargo = cargos::orderby('cargo')->get();
        $horario = grupohorario::orderby('nombre')->get();
        $ubicacion = ubicacion::orderby('descripcion')->get();
        return view('rrhh.empleados.empresa.edit',compact('empleados','empleadoempresa','cargo','horario','ubicacion'));
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
        $empleadoempresa->idubicacion = $request->idubicacion;
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
