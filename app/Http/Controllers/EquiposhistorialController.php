<?php

namespace App\Http\Controllers;

use App\Models\empleados;
use App\Models\equiposfotos;
use App\Models\equiposhistorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquiposhistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controlvehiculo = equiposhistorial::join("empleados as b","equiposhistorials.idempleado","b.id")
        ->join("equipostrabajos as c","equiposhistorials.idequipotrabajo","c.id")
        ->select("equiposhistorials.*","b.codigo","b.nombreCompleto","c.codigo","c.placa")->get();

        return view('general.equipos.index',compact('controlvehiculo'));
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
     * @param  \App\Models\equiposhistorial  $equiposhistorial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idusuario = session()->get('user_id');
        $equiposhistorial = equiposhistorial::join('empleados','idempleado','empleados.id')->join('equipostrabajos','idequipotrabajo','equipostrabajos.id')->select('equiposhistorials.*','empleados.nombreCompleto as empleado','equipostrabajos.codigo','equipostrabajos.placa','equipostrabajos.marca')->orderby('instante','desc')->paginate(5);
        return view('general.equipos.show',compact('equiposhistorial'));
    }
    public function mostrar($id)
    {
        $equipohistorial = equiposhistorial::find($id);
        $equiposfotos = equiposfotos::where('idequipohistorial',$id)->first();
        if(isset($equiposfotos)){
            $foto = asset(Storage::url('app/'.$equiposfotos->imagen));
        }else{
            $foto = asset(Storage::url('app/vehiculos/nofoto.png'));
        }
        return view('general.equipos.mostrar',compact('equipohistorial','foto'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\equiposhistorial  $equiposhistorial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipohistorial = equiposhistorial::find($id);
        if(isset($equipohistorial->uso) && $equipohistorial->uso!="0"){
            $disabled = "disabled";
        }else{
            $disabled = "";
        }
        
        return view('general.equipos.edit',compact('equipohistorial','disabled'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\equiposhistorial  $equiposhistorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$idequipohistorial)
    {
        if(isset($request->foto)){
            $request->validate([
                'uso' => 'required',
                'combustible' => 'required',
                'proyecto' => 'required',
            ]);
        }else{
            $request->validate([
                'uso' => 'required',
                'kilometraje' => 'required|integer',
                'combustible' => 'required',
                'proyecto' => 'required',
            ]);
        }
        $equiposhistorial = equiposhistorial::find($idequipohistorial);
        if(isset($request->foto))
        {
            $foto = $request->file('foto')->store('vehiculos');
            equiposfotos::create([
                'idequipohistorial'=>$idequipohistorial,
                'imagen'=> $foto
            ]);
        }else{
            $foto = 0;
        }
        $equiposhistorial->uso = $request->uso;
        $equiposhistorial->kilometraje = $request->kilometraje;
        $equiposhistorial->combustible = $request->combustible;
        $equiposhistorial->extinguidor = $request->extinguidor;
        $equiposhistorial->botiquin = $request->botiquin;
        $equiposhistorial->equiposeguridad = $request->equiposeguridad;
        $equiposhistorial->observaciones = $request->observaciones;
        $equiposhistorial->proyecto = $request->proyecto;
        $equiposhistorial->save();
        if(session()->has('codigoCarnet')){
            $codigoCarnet = session('codigoCarnet');
            $empleado = empleados::where('codigo',$codigoCarnet)->first();
            $idempleado = $empleado->id;
            $toquen = $empleado->toquen;
            return redirect()->route('asistencia',['a'=>$idempleado,'b'=>$toquen]);
        }else{
            return redirect()->route('equiposhistorial.index')->with('mensaje','Datos guardados correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\equiposhistorial  $equiposhistorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(equiposhistorial $equiposhistorial)
    {
        //
    }
}
