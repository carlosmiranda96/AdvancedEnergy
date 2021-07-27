<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GrupoProductoController extends Controller
{
    public function index()
    {
        $grupo = grupo::paginate(5);
        return view('admin.grupo.lista',compact('grupo'));
    }
}
