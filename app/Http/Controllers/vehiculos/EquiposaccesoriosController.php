<?php

namespace App\Http\Controllers\vehiculos;

use App\Http\Controllers\Controller;
use App\Models\vehiculos\equiposaccesorios;
use Illuminate\Http\Request;

class EquiposaccesoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\vehiculos\equiposaccesorios  $equiposaccesorios
     * @return \Illuminate\Http\Response
     */
    public function show(equiposaccesorios $equiposaccesorios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vehiculos\equiposaccesorios  $equiposaccesorios
     * @return \Illuminate\Http\Response
     */
    public function edit(equiposaccesorios $equiposaccesorios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vehiculos\equiposaccesorios  $equiposaccesorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, equiposaccesorios $equiposaccesorios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vehiculos\equiposaccesorios  $equiposaccesorios
     * @return \Illuminate\Http\Response
     */
    public function destroy(equiposaccesorios $equiposaccesorios)
    {
        //
    }
    public function add(Request $request)
    {
        $idvehiculo = $request->id;
        $descripcion = $request->descripcion;

        $accesorio = new equiposaccesorios;

        $accesorio->idvehiculo = $idvehiculo;
        $accesorio->descripcion = $descripcion;
        $accesorio->save();
    }
    public function get(Request $request){
        $id = $request->id;
        $accesorios = equiposaccesorios::where("idvehiculo",$id)->get();

        $retorno = '<table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $contador = 0;
        foreach($accesorios as $item){
            $retorno = $retorno.'<tr>
                <td>'.$item->descripcion.'</td>
                <td>
                    <form id="frmeliminar{{$item->id}}" method="post" action="{{route('."'equiposaccesorios.destroy'".',$item->id)}}" class="form-inline">
                    @csrf
                    @method("DELETE")
                    <a class="btn btn-sm btn-warning" href="{{ route('."'equiposac'".',$item->id) }}"><i class="fas fa-edit"></i></a>
                    <a onclick="eliminar('.$item->id.')" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                    </form>
                </td>
            </tr>';
            $contador++;
        }
        if($contador==0){
            $retorno = $retorno."<tr><td colspan='2'>Sin datos</td></tr>";
        }
        $retorno = $retorno."</tbody>
        </table>";
        echo $retorno;
    }
    public function delete(Request $request){
        
    }
}