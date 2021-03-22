<?php

namespace App\Http\Controllers;

use App\Models\equipoMantenimiento;
use Illuminate\Http\Request;

class EquipomantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.equipos.mantenimiento.lista');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function programacion()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\equipoMantenimiento  $equipoMantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show(equipoMantenimiento $equipoMantenimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\equipoMantenimiento  $equipoMantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(equipoMantenimiento $equipoMantenimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\equipoMantenimiento  $equipoMantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, equipoMantenimiento $equipoMantenimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\equipoMantenimiento  $equipoMantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(equipoMantenimiento $equipoMantenimiento)
    {
        //
    }
}
