<?php

namespace App\Http\Controllers\rrhh;

use App\Http\Controllers\Controller;
use App\Models\empleados;
use App\Models\rrhh\Carnet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use function Complex\add;

class carnetController extends Controller
{
    public function index()
    {
        $carnet = Carnet::leftjoin("empleados as b","carnets.idempleado","b.id")->select("carnets.*",'b.nombreCompleto as empleado')->paginate(5);
        return view('rrhh.carnet.lista',compact('carnet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Carnet::get()->count()){
            $empleados = empleados::join("carnets as b","empleados.id","!=","b.idempleado")->select("empleados.*")->orderby("nombreCompleto")->get();
        }else{
            $empleados = empleados::leftjoin("carnets as b","empleados.id","!=","b.idempleado")->select("empleados.*")->orderby("nombreCompleto")->get();
        }        
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
        if(Carnet::get()->count()){
            $empleados = empleados::join("carnets as b","empleados.id","!=","b.idempleado")->select("empleados.*")->orderby("nombreCompleto")->get();
        }else{
            $empleados = empleados::leftjoin("carnets as b","empleados.id","!=","b.idempleado")->select("empleados.*")->orderby("nombreCompleto")->get();
        }
        $empleado = empleados::find($carnet->idempleado);
        return view('rrhh.carnet.edit',compact('carnet','empleados','empleado'));
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
            $this->asignarCarnet($request->idempleado,$id);
        }
        $carnet->update($request->all());
        return redirect()->route('carnet.index')->with('mensaje','Datos guardados correctamente');
    }
    private function quitarCarnet($idempleado,$idcarnet){
        $empleado = empleados::find($idempleado);
        $carnet = Carnet::find($idcarnet);
        $empleado->codigo = $empleado->id;
        $empleado->save();
    }
    private function asignarCarnet($idempleado,$idcarnet){
        $empleado = empleados::find($idempleado);
        $carnet = Carnet::find($idcarnet);
        $empleado->codigo = $carnet->codigo;
        $empleado->save();
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
