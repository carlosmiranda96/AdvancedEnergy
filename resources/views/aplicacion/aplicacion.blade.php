@extends('plantillaQR')
@section('pagina')
<div hidden>
    <form id="frmvehiculo" method="post">
        <input id="cant" value="0"/>
        <input id="latitud" name="latitud" value="0"/>
        <input id="longitud" name="longitud" value="0"/>
        <input id="idusuario" value="1"/>
        <input id="idempleado" name="idempleado" value="{{$empleado->id}}">
    </form>
</div>
<div class="row">
    <div class="col-12 text-center pt-2">
        <label class="font-gotham-medium color-secondary">Ubicación</label>
        <select class="input" id="idubicacion">
        </select>
    </div>
</div>
<div class="row pt-5 mt-4 pb-5">
    <div class="col-12">
        <div class="card_amarilla caja">
            <img class="fotoperfil" src="{{asset(Storage::url('app/'.$empleado->foto))}}">
        </div>
    </div>
    <div class="col-12 mt-4 mb-2 pb-2">
        <h5 class="font-gotham-medium color-white text-center">{{$empleado->nombreCompleto}}</h5>
        <h6 class="font-gotham-medium color-secondary text-center m-0 mt-3">Correlativo #</h6>
        <h3 class="font-gotham-medium color-secondary text-center">{{$empleado->codigo}}</h3>
    </div>
    <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
        <div class="row">
            <div class="col-12">
                <div class="card card_amarilla mb-3">
                    <a href="{{route('api.form.covid',$empleado->toquen)}}" style="text-decoration: none;" target="_blank">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col">
                            <div class="h5 mb-0 font-gotham-bold text-center">Cuestionario Covid-19</div>
                        </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="card card_amarilla mb-3">
                    <button onclick="verificarLogin(1)" style="background-color:transparent;border:none;">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col">
                            <div class="h5 mb-0 font-gotham-bold text-center text-secondary">Registrar Asistencia</div>
                        </div>
                        </div>
                    </div>
                    </button>
                </div>
            </div>
            <div class="col-12">
                <div class="card card_amarilla mb-3">
                    <button onclick="verificarLogin(2)" style="background-color:transparent;border:none;">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col">
                            <div class="h5 mb-0 font-gotham-bold text-center text-secondary">Lector QR</div>
                        </div>
                        </div>
                    </div>
                    </button>
                </div>
            </div>
            <div class="col-12">
                <div class="card card_amarilla mb-3">
                    <a href="{{route('login')}}" style="text-decoration: none;" target="_blank">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col">
                            <div class="h5 mb-0 font-gotham-bold text-center">Portal Empleado</div>
                        </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="notificacion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Notificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodynotificacion">
        
      </div>
      <div class="modal-footer">
        <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
<script>
    //METODO PARA OBTENER COORDENADAS GPS
    if(navigator.geolocation){
        //intentamos obtener las coordenadas del usuario
        navigator.geolocation.getCurrentPosition(function(objPosicion){
            //almacenamos en variables la longitud y latitud
            var iLongitud=objPosicion.coords.longitude;
            var iLatitud=objPosicion.coords.latitude;
            $("#latitud").val(iLatitud);
            $("#longitud").val(iLongitud);
            obtenerUbicacion(iLatitud,iLongitud);             
        },function(objError){
            //manejamos los errores devueltos por Geolocation API
            switch(objError.code){
                //no se pudo obtener la informacion de la ubicacion
                case objError.POSITION_UNAVAILABLE:
                    bootbox.alert({
                        title:'Notificación',
                        message:"No se ha podido obtener la ubicación",
                        buttons:{
                            ok:{
                                label:'Cerrar'
                            }
                        }
                    });
                    break;
                    //timeout al intentar obtener las coordenadas
                case objError.TIMEOUT:
                    bootbox.alert({
                        title:'Notificación',
                        message:"Tiempo de espera agotado",
                        buttons:{
                            ok:{
                                label:'Cerrar'
                            }
                        }
                    });
                    break;
                    //el usuario no desea mostrar la ubicacion
                case objError.PERMISSION_DENIED:
                    bootbox.alert({
                        title:'Notificación',
                        message:"Por favor activa el GPS",
                        buttons:{
                            ok:{
                                label:'Cerrar'
                            }
                        }
                    });
                    break;
                    //errores desconocidos
                case objError.UNKNOWN_ERROR:
                    bootbox.alert({
                        title:'Notificación',
                        message:"Error desconocido",
                        buttons:{
                            ok:{
                                label:'Cerrar'
                            }
                        }
                    });
                    break;
            }
        });
    }else{
        //el navegador del usuario no soporta el API de Geolocalizacion de HTML5
        bootbox.alert({
            title:'Notificación',
            message:"El navegador no suporta la Geolocalización",
            buttons:{
            ok:{
                label:'Cerrar'
            }
           }
        });
    }
    //METODO PARA OBTENER LA UBICACION EN LA BD DE ACUERDO A LAS COORDENADS OBTENIDAS
    function obtenerUbicacion(lat,lon){
        var datos = {latitud:lat,longitud:lon};
        $.ajax({
            url:"{{route('api.getUbicacion')}}",
            type:"get",
            data: datos,
            success:function(r)
            {
                var json = JSON.parse(r);
                var contador = 0;
                $.each(json,function(e,key){
                    contador++;
                    $("#idubicacion").append('<option value="'+key.id+'">'+key.descripcion+'</option>');
                });
            }
        });
    }
    var dialogo;
    function verificarLogin(id)
    {
        $.ajax({
            url:"{{route('validarsesion')}}",
            type:"get",
            success:function(r)
            {
                if(r==0){
                    var html = "¡Bienvenido!, para acceder a la opción elegida primero debes iniciar sesión..<br><br>"+
                        "<label>Ingresa tu correo:</label><input id='correo' type='text' value='{{$email}}' class='form-control'/><br>"+
                        "<label>Ingresa tu contraseña:</label><input id='clave' type='password' value='{{$password}}' class='form-control'/><br>"+
                        "<button class='btn btn-primary col-12' onclick='login("+id+")'>Iniciar Sesión</button>";
                    dialogo = bootbox.dialog({
                        title:'Iniciar Sesión',
                        message:html,
                        buttons:{
                            cancel:{
                                label:'Cerrar',
                                className: 'btn-secondary'
                            }
                        }
                    });
                }else if(id==1){
                    //Marcar asistencia
                    asistencia();
                }else if(id==2){
                    //Abrir lector QR
                    window.location = "{{route('lectorqr',['b'=>$empleado->toquen])}}";
                }
            },error:function(){
                bootbox.alert('Error al conectar');
            }
        })
        
    }
    //Metodo para marcar la asistencia
    function asistencia(){
        var content = "{{route('asistencia',['a'=>$empleado->id,'b'=>$empleado->toquen])}}";
        var token = '{{csrf_token()}}';
        var user = $("#idusuario").val();
        var la = $("#latitud").val();
        var lo = $("#longitud").val();
        var ubicacion = $("#idubicacion").val();
        var empleado = $("#idempleado").val();
        var idempleado = $("#idempleadoinicio").val();
        var datos = {contenido:content,_token:token,opcion:'asistencia',idusuario:user,idempleado:empleado,latitud:la,longitud:lo,idubicacion:ubicacion,idempleadoinicio:idempleado,opcion:'asistencia'};
        $.ajax({
            url:"{{route('api.escanear')}}",
            type:"get",
            data: datos,
            success:function(r)
            {
                var json = JSON.parse(r);
                if(json['id']==0){
                    $("#bodynotificacion").html(json['mensaje']);
                }else if(json['id']==1){
                    $("#bodynotificacion").html(json['mensaje']);
                    $("#idubicacion").empty();
                    var jsonUbicacion = JSON.parse(json['json']);
                    $("#idubicacion").append('<option value="'+jsonUbicacion['id']+'">'+jsonUbicacion['ubicacion']+'</option>');
                    $("#idubicacion").append('<option value="0">Seleccione</option>');
                }else if(json['id']==2){
                    $("#bodynotificacion").html(json['mensaje']);
                    $("#idempleado").empty();
                    var jsonEmpleado = JSON.parse(json['json']);
                    $("#idempleado").append('<option value="'+jsonEmpleado['id']+'">'+jsonEmpleado['nombre']+'</option>');
                    $("#idempleado").append('<option value="0">Seleccione</option>');
                }
                $("#notificacion").modal('show');
            }
        });
    }
    function login(id)
    {
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
                        if(id==1){
                            //Marcar asistencia
                            dialogo.modal('hide');
                            asistencia();
                        }else if(id==2){
                            //Abrir lector QR
                            window.location = "{{route('lectorqr',['b'=>$empleado->toquen])}}";
                        }
                    }else{
                        alertify.error(r+"!!");
                    }
                }
            });
        }
    }
</script>
@stop