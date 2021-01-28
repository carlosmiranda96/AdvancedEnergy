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
                    <h3 class="text-primary text-center font-gotham-bold">Cuenta {{$correo}} verificada</h3>
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
                    <h3 class="text-primary text-center font-gotham-bold">El enlace de activación no es válido</h3>
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
    function enviar()
    {
        var clave1 = $("#clave1");
        var clave2 = $("#clave2");
        if(clave1.val()!=clave2.val() || clave1.val()=='')
        {
            alertify.error("Claves no coinciden!!!");
            clave2.focus();
        }
        else if(clave1.val()==123456)
        {
            bootbox.dialog({
                title:"Notificación",
                message:"Clave ingresada no se puede utilizar. Intenta con una contraseña más segura",
                buttons:{
                    cancel:{
                        label:"Ok"
                    }
                }
            })
            clave1.focus();
        }else{
            $.ajax({
                url:"{{route('usuarios.updateclave2')}}",
                type:"POST",
                data:"id={{$idusuario}}&_token={{csrf_token()}}&password="+clave1.val()+"&password2="+clave2.val(),
                success:function(r){
                    if(r==1){
                        var html = "<h5 class='text-primary text-center font-gotham-bold'>Contraseña actualizada!!, ahora ya puedes iniciar sesión..</h5><br>"+
                        "<label>Ingresa tu correo:</label><input id='correo' type='text' value='' class='form-control input'/><br>"+
                        "<label>Ingresa tu contraseña:</label><input id='clave' type='password' value='' class='form-control input'/><br>"+
                        "<button class='btn btn-primary col-12' onclick='login()'>Iniciar Sesión</button>";
                        bootbox.dialog({
                            title:'Iniciar Sesión',
                            message:html,
                            closeButton: false
                        });
                    }else{
                        bootbox.dialog({
                            title:"Notificación",
                            message:r,
                            buttons:{
                                cancel:{
                                    label:"Ok"
                                }
                            }
                        })
                    }
                },
                error:function(){
                    bootbox.alert("Error");
                }
            });
        }
    }
    function login(){
        var correo = $("#correo");
        var clave = $("#clave");
        if(!correo.val()){
            alertify.error("Ingrese un correo");
            correo.focus();
        }else if(!clave.val()){
            alertify.error("Ingrese una contraseña");
            clave.focus();
        }else{
            $.ajax({
                url:"{{asset('validaruser')}}/"+correo.val()+"/"+clave.val(),
                type:"GET",
                data:"crear=1",
                success:function(r)
                {
                    if(r==1){
                        window.location = "{{route('inicio')}}";
                    }else{
                        alertify.error(r+"!!");
                    }
                }
            });
        }
    }
</script>
@stop