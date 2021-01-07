<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = session('user_id');
        $usuario = User::where('idrol',1)->where('id',$user_id)->first();
        if(isset($usuario)){
            return $next($request);
        }else{
            if($request->route()->named('usuarios.clave')||$request->route()->named('usuarios.updateclave')){
                if($request->id==$user_id){
                    return $next($request);
                }
            }
            if($request->route()->named('usuarios.edit'))
            {
                return redirect()->route('aj_perfil');
            }
            return redirect()->route('inicio');
        }
    }
}
