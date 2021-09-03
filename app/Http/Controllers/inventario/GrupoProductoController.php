<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\grupoProducto;

class GrupoProductoController extends Controller
{
    public function index()
    {
        $grupo = grupoProducto::paginate(5);
        return view('admin.grupo.lista',compact('grupo'));
    }
}
