<?php

namespace App\Http\Controllers;

use App\Models\modulos;
use Illuminate\Http\Request;

class modulosController extends Controller
{
    public function index()
    {
        $modulos = modulos::orderby('modulo')->paginate(5);
        return view('admin.modulos.lista',compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function crear(Request $request)
    {
        $nivel = $request->nivel+1;
        $dependencia = $request->id;
        
        $final = modulos::where('nivel',$nivel)->where('dependencia',$dependencia)->orderby('orden','desc')->first();
        if(isset($final)){
            $orden = $final->orden+1;
        }else{
            $orden = 1;
        }
        $request->nivel = $nivel;
        $request->orden = $orden;

        return view('admin.modulos.create',compact('request'));
    }
    
    public function create()
    {
        return view('admin.modulos.create');
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
            'modulo' => 'required'
        ]);
        modulos::create([
            'modulo' => $request->modulo,
            'ruta' => $request->ruta,
            'icono' => $request->icono,
            'nivel' => $request->nivel,
            'dependencia' => $request->dependencia,
            'orden' => $request->orden
        ]);
        return redirect()->route('modulos.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(modulos $modulos)
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
        $modulos = modulos::find($id);
        return view('admin.modulos.edit',compact('modulos'));
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
            'modulo' => 'required'
        ]);
        $modulos = modulos::find($id);
        $modulos->update($request->all());
        return redirect()->route('modulos.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modulos = modulos::find($id);
        $modulos->delete();
        return redirect()->route('modulos.index')->with('mensaje','Dato eliminado correctamente');
    }
}
