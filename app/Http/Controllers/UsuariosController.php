<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class UsuariosController extends Controller
{
    public function __construct()
    {
        //return redirect()->route('login');
    }
    public function index()
    {
        $usuarios = User::paginate(5);
        return view('admin.usuarios.lista',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enviar = $request->invitacion;
        if(isset($enviar)){
            $request->validate([
                'name' => 'required',
                'email' => 'required'
            ]);
        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'idrol' => 'required|integer|min:1',
                'password' => 'required',
            ]);
        }
        if(isset($request->foto)){
            $foto = $request->file('foto')->store('fotoperfil');
        }else{
            $foto = "fotoperfil/perfilDefault.jpg";
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Crypt::encryptString($request->password),
            'foto' => $foto,
            'idrol' => $request->idrol,
            'idempleado' => $request->idempleado,
            'estado' => 1
        ]);
        return redirect()->route('usuarios.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuarios)
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
        $usuarios = User::find($id);
        return view('admin.usuarios.edit',compact('usuarios'));
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
        $usuario = User::find($id);
        if(isset($request->foto))
        {
            if($usuario->foto!="fotoperfil/perfilDefault.jpg"){
                Storage::delete($usuario->foto);//Elimino foto anterior
            }
            $foto = $request->file('foto')->store('fotoperfil');//subo foto nueva
            if(session()->get('user_id')==$id){
                session()->put('foto','storage/app/'.$foto);
            }
            $usuario->update(["foto"=>$foto]);
            echo $foto;
        }else{
            $idrol = $usuario->idrol;
            if($idrol==1){
                $request->validate([
                    'name' => 'required|unique:users,name,'.$usuario->id.',id',
                    'email' => 'required|unique:users,email,'.$usuario->id.',id',
                    'idrol' => 'required'
                ]);
            }else{
                $request->validate([
                    'name' => 'required|unique:users,name,'.$usuario->id.',id',
                    'email' => 'required|unique:users,email,'.$usuario->id.',id'
                ]);
            }
            if($id==1){
                $request->idrol = 1;
            }
            $usuario->update($request->all());
            if($idrol==1){
                return redirect()->route('usuarios.index')->with('mensaje','Datos guardados correctamente');
            }else{
                return redirect()->route('aj_perfil')->with('mensaje','Datos guardados correctamente');
            }
        }
    }
    public function cambiarclave($id)
    {
        $usuarios = User::find($id);
        return view('admin.usuarios.cambiarclave',compact('usuarios'));
    }
    public function updateclave(Request $request,$id)
    {
        $request->validate([
            'password' => 'required',
            'password2' => 'required'
        ]);
        if($request->password==$request->password2)
        {
            $usuario = User::find($id);
            $usuario->update([
                'password' =>Crypt::encryptString($request->password)
            ]);
            if($usuario->id==1){
                return redirect()->route('usuarios.edit',$id)->with('mensaje','Clave actualizada correctamente');
            }else{
                return redirect()->route('aj_perfil')->with('mensaje','Clave actualizada correctamente');
            }
        }else{
            return redirect()->route('usuarios.clave',$id)->with('mensaje','No coinciden las claves ingresadas');
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
        $usuarios = User::find($id);
        if($usuarios->foto!="fotoperfil/perfilDefault.jpg"){
            Storage::delete($usuarios->foto);//Elimino foto anterior
        }
        $usuarios->delete();
        return redirect()->route('usuarios.index')->with('mensaje','Dato eliminado correctamente');
    }
}
