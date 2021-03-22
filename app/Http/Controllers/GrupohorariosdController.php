<?php

namespace App\Http\Controllers;

use App\Models\grupohorariosd;
use App\Models\grupohorario;
use App\Models\dias;
use Illuminate\Http\Request;

class GrupohorariosdController extends Controller
{
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'iddia' => 'required|integer|min:1',
            'horainicio' => 'required',
            'horafin' => 'required'
        ]);
        grupohorariosd::create([
            'idgrupohorario' => $request->idgrupohorario,
            'iddia' => $request->iddia,
            'horainicio' => $request->horainicio,
            'horafin' => $request->horafin
        ]);
        //return redirect()->route('grupohorariosd.index')->with('mensaje','Datos guardados correctamente');
        return redirect()->route('grupohorario.show',$request->idgrupohorario)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //FUNCION PARA CREAR UN NUEVO HORARIO
        $grupohorario = grupohorario::find($id);
        $dias = dias::get();
        return view('admin.horariosd.create',compact('grupohorario','dias'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupohorariosd = grupohorariosd::find($id);
        $grupohorario = grupohorario::find($grupohorariosd->idgrupohorario);
        $dias = dias::all();
        return view('admin.horariosd.edit',compact('grupohorariosd','grupohorario','dias'));
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
            'iddia' => 'required|integer|min:1',
            'horainicio' => 'required',
            'horafin' => 'required'
        ]);
        $grupohorariosd = grupohorariosd::find($id);
        $grupohorariosd->update($request->all());
        return redirect()->route('grupohorario.show',$request->idgrupohorario)->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupohorariosd = grupohorariosd::find($id);
        $idgrupohorario = $grupohorariosd->idgrupohorario;
        $grupohorariosd->delete();
        return redirect()->route('grupohorario.show',$idgrupohorario)->with('mensaje','Datos guardados correctamente');
    }
}
