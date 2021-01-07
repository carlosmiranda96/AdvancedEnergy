<?php

namespace App\Http\Controllers;

use App\Models\grupohorario;
use App\Models\grupohorariosd;
use Illuminate\Http\Request;

class GrupohorariosController extends Controller
{
    public function index()
    {
        $horarios = grupohorario::paginate(5);
        return view('admin.horarios.lista',compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.horarios.create');
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
            'nombre' => 'required'
        ]);
        grupohorario::create([
            'nombre' => $request->nombre
        ]);
        return redirect()->route('grupohorario.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupohorario = grupohorario::find($id);
        $grupohorariosd = grupohorariosd::join('dias','grupohorariosds.iddia','=','dias.id')->select('grupohorariosds.*','dias.dia')->where('idgrupohorario',$id)->paginate(5);
        return view('admin.horarios.show',compact('grupohorario','grupohorariosd'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupohorario = grupohorario::find($id);
        return view('admin.horarios.edit',compact('grupohorario'));
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
            'nombre' => 'required'
        ]);
        $grupohorario = grupohorario::find($id);
        $grupohorario->update($request->all());
        return redirect()->route('grupohorario.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupohorario = grupohorario::find($id);
        $grupohorario->delete();
        return redirect()->route('grupohorario.index')->with('mensaje','Dato eliminado correctamente');
    }
}
