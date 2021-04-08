<?php

namespace App\Http\Controllers;

use App\Mail\Registro;
use App\Mail\Restablecer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;

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
        $toquen = NULL;
        $enviar = $request->invitacion;
        $estado = 1;
        $idrol = 2;
        $clave = $request->password;
        $hora = date('d/m/Y h:i:s');
        if(isset($enviar)){
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users'
            ]);
            //crear toquen para usuario
            $toquen = substr(Crypt::encryptString($hora),0,20);
            $estado = 0;
            $clave = 123456;
        }else{
            if($request->idrol==1){
                $idrol = 1;
            }
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'idrol' => 'required|integer|min:1',
                'password' => 'required',
            ]);
        }
        if(isset($request->foto)){
            $foto = $request->file('foto')->store('fotoperfil');
        }else{
            $foto = "fotoperfil/perfilDefault.jpg";
        }

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Crypt::encryptString($clave),
            'remember_token' => $toquen,
            'foto' => $foto,
            'idrol' => $idrol,
            'idempleado' => $request->idempleado,
            'estado' => $estado
        ]);
        if(isset($enviar)){
            //Enviara correo de notificacion de usuario creado para validar cuenta
            Mail::to($usuario->email)->send(new Registro($usuario->id));
        }
        return redirect()->route('usuarios.index')->with('mensaje','Datos guardados correctamente');
    }
    public function restablecer(Request $request)
    {
        //Restablecer por ID de usuario
        $idusuario = $request->id;
        $mail = User::find($idusuario)->email;
        if(isset($mail)){
            Mail::to($mail)->send(new Restablecer($idusuario));
            echo "Correo enviado";
        }else{
            echo "No hay correo disponible";
        }
        
    }
    public function restablecer2(Request $request)
    {
       //Restablecer por correo de usuario
       $email = $request->email;
       $mail = User::where('email',$email)->first();
       if(isset($mail)){
           Mail::to($mail)->send(new Restablecer($mail->id));
           echo "Solicitud recibida!!!<br>Se te ha enviado un correo electronico para restablecer la contraseña!!";
       }else{
           echo "Correo no válido!!";
       }
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
            if($id==1){//Si es supervisor
                $request->idrol = 1;
            }
            $usuario->update($request->all());
            $perfil = $request->perfil;
            if(isset($perfil))
            {
                return redirect()->route('aj_perfil')->with('mensaje','Datos guardados correctamente');
            }else{
                return redirect()->route('usuarios.index')->with('mensaje','Datos guardados correctamente');
            }
        }
    }
    public function cambiarclave($id,Request $request)
    {
        $perfil = $request->perfil;
        $usuarios = User::find($id);
        return view('admin.usuarios.cambiarclave',compact('usuarios','perfil'));
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
            if(isset($request->perfil)){
                return redirect()->route('aj_perfil')->with('mensaje','Clave actualizada correctamente');
            }else{
                return redirect()->route('usuarios.edit',$id)->with('mensaje','Clave actualizada correctamente');
            }
        }else{
            return redirect()->route('usuarios.clave',$id)->with('mensaje','No coinciden las claves ingresadas');
        }
    }
    public function updateclave2(Request $request)
    {
        if($request->password==$request->password2)
        {
            $usuario = User::find($request->id);
            if($usuario){
                $hora = date('d/m/Y h:i:s');
                $toquen = substr(Crypt::encryptString($hora),0,20);
                //Actualizar usuario
                $usuario->password = Crypt::encryptString($request->password);
                //ACTIVAR LA CUENTA
                $usuario->estado = 1;
                $usuario->remember_token = $toquen;
                $usuario->update();
                echo "1";
            }else{
                echo "No se ha encontrado el usuario";
            }
        }else{
            echo "La clave no se ha podido actualizar";
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
