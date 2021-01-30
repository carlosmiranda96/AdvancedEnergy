<?php

namespace App\Http\Controllers;

use App\Models\userAcceso;
use Illuminate\Http\Request;

class userAccesoController extends Controller
{
    public function index()
    {
        $userAcceso = userAcceso::orderby('userAcceso')->paginate(5);
        return view('admin.userAcceso.lista',compact('userAcceso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.userAcceso.create');
    }
    public function getDepartamento(Request $request)
    {
        $svdepartamento = svdepartamento::orderby('codigo')->where('iduserAcceso',$request->iduserAcceso)->get();
        echo json_encode($svdepartamento);
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
            'userAcceso' => 'required'
        ]);
        userAcceso::create([
            'userAcceso' => $request->userAcceso,
        ]);
        return redirect()->route('userAcceso.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(userAcceso $userAcceso)
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
        $userAcceso = userAcceso::find($id);
        return view('admin.userAcceso.edit',compact('userAcceso'));
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
            'userAcceso' => 'required'
        ]);
        $userAcceso = userAcceso::find($id);
        $userAcceso->update($request->all());
        return redirect()->route('userAcceso.index')->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userAcceso = userAcceso::find($id);
        $userAcceso->delete();
        return redirect()->route('userAcceso.index')->with('mensaje','Dato eliminado correctamente');
    }
}
