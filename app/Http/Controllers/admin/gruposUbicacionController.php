<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\grupo;
use App\Models\gruposUbicacion;
use App\Models\ubicacion;
use Illuminate\Http\Request;

class gruposUbicacionController extends Controller
{
    public function index($idgrupo)
    {
        $grupo = grupo::find($idgrupo);
        $miembros = gruposUbicacion::join('ubicacions','grupos_ubicacions.idubicacion','ubicacions.id')->select('ubicacions.*','grupos_ubicacions.id as key')
        ->where('idgrupo',$idgrupo)->get();
        
        $user = gruposUbicacion::where('idgrupo',$idgrupo)->select('idubicacion')->get();
        $ubicaciones = ubicacion::whereNotIn('id',$user)->orderby('descripcion')->get();

        return view('admin.grupo.ubicaciones.lista',compact('idgrupo','miembros','ubicaciones','grupo'));
    }
    public function add(Request $request)
    {
        $idubicacion = $request->idubicacion;
        $idgrupo = $request->idgrupo;

        $gruposUbicacion = new gruposUbicacion();
        $gruposUbicacion->idubicacion = $idubicacion;
        $gruposUbicacion->idgrupo = $idgrupo;
        $gruposUbicacion->save();

        echo "1";
    }
    public function destroy($id)
    {
        $miembro = gruposUbicacion::find($id);
        $miembro->delete();
        return back();
    }
}
