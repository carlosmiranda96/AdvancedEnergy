<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PageAjustesController extends Controller
{
    public function __construct()
    {
        
    }
    public function equipos()
    {
        return view('admin.equipos');
    }
    public function permisos()
    {
        return view('admin.permisos');
    }
    public function usuarios()
    {
        return view('admin.usuarios');
    }
    public function autorizacion()
    {
        return view('admin.autorizacion');
    }
    public function perfil()
    {
        $userid = session('user_id');
        $usuarios = User::find($userid);
        return view('perfil.perfil',compact('usuarios'));
    }
}
