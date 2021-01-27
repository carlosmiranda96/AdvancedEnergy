@extends('plantillaQR')
@section('pagina')
<div class="container">
    <div class="row">
        <div class="col-12 pt-5">
            @if($valido)
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                    <img src="{{asset('img/ok.png')}}" width="100px">
                    <hr>
                    <h3 class="text-primary text-center font-gotham-bold">El correo {{$correo}} ha sido verificado</h3>
                    <hr>
                    </div>
                    <h4 class="text-center">Crea una contraseña</h4>
                    <div class="col-lg-6 offset-lg-3">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" id="clave1" name="clave1" class="form-control input"/>
                        </div>
                        <div class="form-group">
                            <label>Repite Contraseña</label>
                            <input type="password" id="clave2" name="clave2" class="form-control input"/>
                        </div>
                        <div class="form-group">
                            <button onclick="enviar()" class="btn btn-primary col-12">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{asset('img/cancel.png')}}" width="100px">
                    <hr>
                    <h3 class="text-primary text-center font-gotham-bold">Cuenta no válida</h3>
                    <hr>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    function enviar(){
        var html = "¡Bienvenido!, para acceder a la opción elegida primero debes iniciar sesión..<br><br>"+
                        "<label>Ingresa tu correo:</label><input id='correo' type='text' value='' class='form-control'/><br>"+
                        "<label>Ingresa tu contraseña:</label><input id='clave' type='password' value='' class='form-control'/><br>"+
                        "<button class='btn btn-primary col-12' onclick='login()'>Iniciar Sesión</button>";
        bootbox.dialog({
            title:'Iniciar Sesión',
            message:html,
            closeButton: false
        });
    }
</script>
@stop