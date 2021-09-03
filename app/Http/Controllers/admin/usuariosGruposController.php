<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\grupo;
use App\Models\User;
use App\Models\usuariosGrupo;
use Illuminate\Http\Request;

class usuariosGruposController extends Controller
{
    public function index($idgrupo)
    {
        $grupo = grupo::find($idgrupo);
        $miembros = usuariosGrupo::join('users','usuarios_grupos.idusuario','users.id')->select('users.*','usuarios_grupos.id as key')->where('idgrupo',$idgrupo)->get();
        
        $user = usuariosGrupo::where('idgrupo',$idgrupo)->select('idusuario')->get();
        $usuarios = User::where('estado',1)->whereNotIn('id',$user)->orderby('name')->get();

        return view('admin.grupo.usuarios.lista',compact('idgrupo','miembros','usuarios','grupo'));
    }
    public function add(Request $request)
    {
        $idusuario = $request->idusuario;
        $idgrupo = $request->idgrupo;

        $usuariosgrupos = new usuariosGrupo();
        $usuariosgrupos->idusuario = $idusuario;
        $usuariosgrupos->idgrupo = $idgrupo;
        $usuariosgrupos->save();

        echo "1";
    }
    public function destroy($id)
    {
        $miembro = usuariosGrupo::find($id);
        $miembro->delete();
        return back();
    }
}
