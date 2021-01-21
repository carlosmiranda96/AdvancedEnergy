<?php

namespace App\Http\Controllers;

use App\Models\autorizacionusuarios;
use App\Models\permisos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AutorizacionController extends Controller
{
    public function index()
    {
        $autorizacionusuarios = autorizacionusuarios::leftJoin('users','idusuario','users.id')->select('users.id','name as usuario')->groupby('users.id','name')->paginate(5);
        return view('admin.autorizacion.lista',compact('autorizacionusuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::get();
        return view('admin.autorizacion.create',compact('usuarios'));
    }
    public function usuario()
    {
        $usuarios = User::get();
        return view('admin.autorizacion.lista',compact('usuarios'));
    }
    public function grupo()
    {
        $autorizacionusuarios = autorizacionusuarios::leftJoin('users','idusuario','users.id')->select('users.id','name as usuario')->groupby('users.id','name')->paginate(5);
        return view('admin.autorizacion.lista',compact('autorizacionusuarios'));
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
            'idusuario' => 'required|integer|min:1|unique:autorizacionusuarios',
            'permiso' => 'required',
        ]);
        foreach($request->permiso as $item){
            autorizacionusuarios::create([
                'idusuario' => $request->idusuario,
                'idpermiso' => $item
            ]);
        }
        return redirect()->route('autorizacion.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(autorizacionusuarios $autorizacionusuarios)
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
        $autorizacionusuarios = autorizacionusuarios::select('idpermiso')->where('idusuario',$id)->get();
        $usuario = User::find($id);
        $permisos = permisos::join('modulos','idmodulo','modulos.id')->select('permisos.*','modulos.modulo')->orderby('modulos.modulo')->get();
        $arreglo = array();
        $contador = 0;
        foreach($autorizacionusuarios as $item)
        {
            $arreglo[$contador] = $item->idpermiso;
            $contador++;
        }
        return view('admin.autorizacion.edit',compact('arreglo','usuario','permisos'));
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
            'permiso' => 'required',
        ]);
        $autorizacionusuarios = autorizacionusuarios::where('idusuario',$id)->get();
        $arreglo = array();
        $contador = 0;
        foreach($autorizacionusuarios as $aut){
            if(!in_array($aut->idpermiso,$request->permiso)){
                $borrar = autorizacionusuarios::find($aut->id);
                $borrar->delete();
            }
            $arreglo[$contador] = $aut->idpermiso;
            $contador++;
        }
        foreach($request->permiso as $item){
            if(!in_array($item,$arreglo)){
                autorizacionusuarios::create([
                    'idusuario' => $id,
                    'idpermiso' => $item
                ]);
            }
        }
        return redirect()->route('autorizacion.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($idusuario)
    {
        $autorizacionusuarios = autorizacionusuarios::where('idusuario',$idusuario);
        $autorizacionusuarios->delete();
        return redirect()->route('autorizacion.index')->with('mensaje','Dato eliminado correctamente');
    }
}
