@extends('mail.plantilla')
@section('pagina')
<div class="body">
    <h1>¡Bienvenido! {{$usuario->name}}</h1>
    <hr>
    <p>Tu correo se registro correctamente en https://portal.ae-energiasolar.com. Por favor activa tu cuenta en el siguiente enlace.</p>
    <br>
    <center><a href="https://portal.ae-energiasolar.com/validate?a={{$usuario->id}}&b={{$usuario->email}}&c={{$usuario->remember_token}}"><button class="boton">Activar cuenta</button></a></center>
</div>
@stop

        
