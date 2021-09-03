<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\empleados;
use App\Models\grupo;
use App\Models\gruposEmpleados;
use Illuminate\Http\Request;

class gruposEmpleadosController extends Controller
{
    public function index($idgrupo)
    {
        $grupo = grupo::find($idgrupo);
        $miembros = gruposEmpleados::join('empleados','grupos_empleados.idempleado','empleados.id')->select('empleados.*','grupos_empleados.id as key')
        ->where('idgrupo',$idgrupo)->get();
        
        $user = gruposEmpleados::where('idgrupo',$idgrupo)->select('idempleado')->get();

        $empleados = empleados::where('estado',1)->whereNotIn('id',$user)->orderby('nombreCompleto')->get();

        return view('admin.grupo.empleados.lista',compact('idgrupo','miembros','empleados','grupo'));
    }
    public function add(Request $request)
    {
        $idempleado = $request->idempleado;
        $idgrupo = $request->idgrupo;

        $gruposEmpleados = new gruposEmpleados();
        $gruposEmpleados->idempleado = $idempleado;
        $gruposEmpleados->idgrupo = $idgrupo;
        $gruposEmpleados->save();

        echo "1";
    }
    public function destroy($id)
    {
        $miembro = gruposEmpleados::find($id);
        $miembro->delete();
        return back();
    }
}
