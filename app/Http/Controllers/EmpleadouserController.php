<?php

namespace App\Http\Controllers;

use App\Models\empleados;
use App\Models\empleadoUser;
use App\Models\User;
use Illuminate\Http\Request;

class EmpleadouserController extends Controller
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
        $usuarios = User::orderby('name')->get();
        return view('rrhh.empleados.user.create',compact('empleados','usuarios'));
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
            'idusuario' => 'required'
        ]);
        empleadouser::create($request->all());
        return redirect()->route('empleadouser.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\empleadouser  $empleadouser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleados = empleados::find($id);
        $empleadouser = empleadouser::join('users','idusuario','users.id')->select('empleado_users.*','users.name')->where('idempleado',$id)->paginate();
        return view('rrhh.empleados.user.show',compact('empleados','empleadouser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empleadouser  $empleadouser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleadouser = empleadouser::find($id);
        $empleados = empleados::find($empleadouser->idempleado);
        $usuarios = User::orderby('name')->get();
        return view('rrhh.empleados.user.edit',compact('empleados','empleadouser','usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empleadouser  $empleadouser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $empleadouser = empleadouser::find($id);
        $empleadouser->update($request->all());
        return redirect()->route('empleadouser.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empleadouser  $empleadouser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleadouser = empleadouser::find($id);
        $idempleado = $empleadouser->idempleado;
        $empleadouser->delete();
        return redirect()->route('empleadouser.show',$idempleado)->with('mensaje','Dato eliminado correctamente');
    }
}
