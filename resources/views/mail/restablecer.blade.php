
@extends('mail.plantilla')
@section('pagina')
<div class="body">
    <h1>Restablecer Contraseña</h1>
    <hr>
    <p>Se ha solicitado restablecer la contraseña de tu cuenta. Utiliza el siguiente enlace para cambiar tu contraseña</p>
    <br>
    <center><a href="https://portal.ae-energiasolar.com/validate?a={{$usuario->id}}&b={{$usuario->email}}&c={{$usuario->remember_token}}"><button class="boton">Restablecer contraseña</button></a></center>
</div>
@stop

        