<?php

namespace App\Http\Controllers\rrhh;

use App\Http\Controllers\Controller;
use App\Models\empleados;
use App\Models\rrhh\Carnet;
use App\Models\rrhh\Carnethistorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use function Complex\add;

class carnetController extends Controller
{
    public function __construct()
	{
		date_default_timezone_set('America/El_Salvador');
	}
    public function index()
    {
        $carnet = Carnet::leftjoin("empleados as b","carnets.idempleado","b.id")->select("carnets.*",'b.nombreCompleto as empleado')->get();
        return view('rrhh.carnet.lista',compact('carnet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = empleados::leftjoin("carnets as b","empleados.id","b.idempleado")
        ->where("b.id",null)
        ->where("empleados.estado",'1')
        ->orderby('empleados.nombreCompleto')
        ->select("empleados.*")->get();     
        
        return view('rrhh.carnet.create',compact('empleados'));
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
            'codigo' => 'required|unique:carnets',
            'fechavencimiento' => 'required',
            'idempleado' => 'required',
        ]);
        $toquen = substr(Crypt::encryptString($request->codigo),0,20);
        $carnet = Carnet::create([
            'codigo' => $request->codigo,
            'fechavencimiento' => $request->fechavencimiento,
            'idempleado' => $request->idempleado,
            'toquen' => $toquen,
        ]);
        $this->asignarCarnet($request->idempleado,$carnet->id);
        if($request->idempleado>0){
            //Registrar historial
            $this->historial($request->idempleado,$carnet->id);
        }
        return redirect()->route('carnet.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carnet = Carnet::find($id);
        return view('rrhh.carnet.show',compact('carnet'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carnet = Carnet::find($id);
        
        $empleados = empleados::leftjoin("carnets as b","empleados.id","b.idempleado")
        ->where("b.id",null)
        ->where("empleados.estado",'1')
        ->orwhere("empleados.id",$carnet->idempleado)
        ->orderby('empleados.nombreCompleto')
        ->select("empleados.*")->get();
        
        $empleado = empleados::find($carnet->idempleado);
        $historial = Carnethistorial::leftjoin("empleados as b","carnethistorials.idempleado","b.id")->
        where("idcarnet",$id)->orderby("carnethistorials.fecha")->orderby("carnethistorials.hora")->get();
        return view('rrhh.carnet.edit',compact('carnet','empleados','empleado','historial'));
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
            'codigo' => 'required|unique:carnets,codigo,'.$id.',id',
            'fechavencimiento' => 'required',
            'idempleado' => 'required',
        ]);
        $carnet = Carnet::find($id);
        $idempleadoanterior = $carnet->idempleado;
        if($idempleadoanterior!=$request->idempleado){
            $this->quitarCarnet($idempleadoanterior,$id);
            //Si se cambio guardar historial de cambio
            //$this->historial($request->idempleado,$id);
        }
        //if($request->idempleado>0){
        $this->historial($request->idempleado,$carnet->id);
        //}
        $this->asignarCarnet($request->idempleado,$request->codigo);
        $carnet->update($request->all());
        return redirect()->route('carnet.index')->with('mensaje','Datos guardados correctamente');
    }
    private function historial($idempleado,$idcarnet)
    {
        //Registra asignacion de carnet
        $idusuario = 1;
        $sesion = session('user_id');
        if(isset($sesion))
        {
            $idusuario = session('user_id');
        }
        if(session('user_id')){
            $idusuario = session('user_id');
        }
        $historial = Carnethistorial::where('idcarnet',$idcarnet)
        ->orderby("fecha","desc")
        ->orderby("hora","desc")->first();
        if($historial && $historial->idempleado==$idempleado){

        }else{
            Carnethistorial::create([
                'fecha' => date("y-m-d"),
                'hora' => date("H:i:s"),
                'idcarnet' => $idcarnet,
                'idempleado' => $idempleado,
                'idusuario' => $idusuario
            ]);
        }
    }
    private function quitarCarnet($idempleado,$idcarnet){
        if($idempleado>0){
            $empleado = empleados::find($idempleado);
            $empleado->codigo = $empleado->id;
            $empleado->save();
        }
    }
    private function asignarCarnet($idempleado,$codigo){
        if($idempleado>0){
            $empleado = empleados::find($idempleado);
            $empleado->codigo = $codigo;
            $empleado->save();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carnet = Carnet::find($id);
        $this->quitarCarnet($carnet->idempleado,$id);
        $carnet->delete();
        return redirect()->route('carnet.index')->with('mensaje','Dato eliminado correctamente');
    }
}
