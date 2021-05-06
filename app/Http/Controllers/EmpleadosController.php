<?php

namespace App\Http\Controllers;
use App\Models\empleados;
use App\Models\estadocivil;
use App\Models\genero;
use App\Models\pais;
use App\Models\svdepartamento;
use App\Models\svmunicipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        return redirect()->route('login');
    }
    public function index()
    {
        $empleados = empleados::get();
        return view('rrhh.empleados.lista',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadocivil = estadocivil::orderby('estadocivil')->get();
        $genero = genero::orderby('genero')->get();
        $departamento = svdepartamento::orderby('codigo')->get();
        $pais = pais::orderby('pais')->get();
        return view('rrhh.empleados.create',compact('estadocivil','genero','departamento','pais'));
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
            'nombre1' => 'required',
            'apellido1' => 'required',
            'nombrecompleto' => 'required',
            'idestadocivil' => 'required|integer|min:1',
            'idgenero' => 'required|integer|min:1',
            'idmunicipio' => 'required|integer|min:1',
            'fechaingreso' => 'required',
            'estado' => 'required'
        ]);
        if(isset($request->foto)){
            $foto = $request->file('foto')->store('fotoempleado');
        }else{
            $foto = "fotoempleado/perfilDefault.jpg";
        }
        $id = empleados::orderby('id','desc')->first()->id;
        $id++;
        $toquen = substr(Crypt::encryptString($request->codigo),0,20);
        $empleado = new empleados;
        $empleado->fechaingreso = $request->fechaingreso;
        $empleado->codigo = $id;
        $empleado->nombre1 = $request->nombre1;
        $empleado->nombre2 = $request->nombre2;
        $empleado->apellido1 = $request->apellido1;
        $empleado->apellido2 = $request->apellido2;
        $empleado->apellido3 = $request->apellido3;
        $empleado->nombrecompleto = $request->nombrecompleto;
        $empleado->foto = $foto;
        $empleado->direccion = $request->direccion;
        $empleado->correo = $request->correo;
        $empleado->telefono = $request->telefono;
        $empleado->celular = $request->celular;
        $empleado->fechanacimiento = $request->fechanacimiento;
        $empleado->idgenero = $request->idgenero;
        $empleado->idestadocivil = $request->idestadocivil;
        $empleado->idmunicipio = $request->idmunicipio;
        $empleado->estado = $request->estado;
        $empleado->toquen = $toquen;
        $empleado->save();
        return redirect()->route('empleadodocumento.show',empleados::latest('id')->first())->with('mensaje','Datos guardados correctamente');
    }
    public function updateGrupo(Request $request)
    {
        $idempleado = $request->idempleado;
        $idgrupo = $request->grupo;

        $empleado = empleados::find($idempleado);
        $empleado->idgrupo = $idgrupo;
        $empleado->save();
        echo "Datos guardados";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(empleados $empleados)
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
        $empleados = empleados::find($id);
        $estadocivil = estadocivil::orderby('estadocivil')->get();
        $genero = genero::orderby('genero')->get();
        $municipio = svmunicipio::find($empleados->idmunicipio);
        $municipios = svmunicipio::where('iddepartamento',$municipio->iddepartamento)->get();
        $departamentos = svdepartamento::orderby('codigo')->get();
        $departamento = svdepartamento::find($municipio->iddepartamento);
        $pais = pais::all();
        //$departamentos = svdepartamento::find($);
        return view('rrhh.empleados.edit',compact('empleados','estadocivil','genero','departamento','departamentos','municipio','municipios','pais'));
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
            'nombre1' => 'required',
            'apellido1' => 'required',
            'nombrecompleto' => 'required',
            'idestadocivil' => 'required|integer|min:1',
            'idgenero' => 'required|integer|min:1',
            'idmunicipio' => 'required|integer|min:1',
            'fechaingreso' => 'required',
            'estado' => 'required',
            'codigo' => 'required',
        ]);
        $empleados = empleados::find($id);
        if(isset($request->foto))
        {
            if($empleados->foto!="fotoempleado/perfilDefault.jpg"){
                Storage::delete($empleados->foto);//Elimino foto anterior
            }
            $foto = $request->file('foto')->store('fotoempleado');
        }else{
            $foto = $empleados->foto;
        }
        $empleados->fechaingreso = $request->fechaingreso;
        $empleados->codigo = $request->codigo;
        $empleados->nombre1 = $request->nombre1;
        $empleados->nombre2 = $request->nombre2;
        $empleados->apellido1 = $request->apellido1;
        $empleados->apellido2 = $request->apellido2;
        $empleados->apellido3 = $request->apellido3;
        $empleados->nombrecompleto = $request->nombrecompleto;
        $empleados->foto = $foto;
        $empleados->direccion = $request->direccion;
        $empleados->correo = $request->correo;
        $empleados->telefono = $request->telefono;
        $empleados->celular = $request->celular;
        $empleados->fechanacimiento = $request->fechanacimiento;
        $empleados->idgenero = $request->idgenero;
        $empleados->idestadocivil = $request->idestadocivil;
        $empleados->idmunicipio = $request->idmunicipio;
        $empleados->estado = $request->estado;
        $empleados->save();
        return redirect()->route('empleados.edit',$id)->with('mensaje','Datos guardados correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleados = empleados::find($id);

        if($empleados->foto!="fotoempleado/perfilDefault.jpg"){
            Storage::delete($empleados->foto);//Elimino foto anterior
        }
        $empleados->delete();
        return redirect()->route('empleados.index')->with('mensaje','Dato eliminado correctamente');
    }
}
