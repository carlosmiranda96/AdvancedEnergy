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
        @if(session('name'))
            <label class="font-gotham-medium color-secondary">Identificado como {{session('name')}} <button onclick="cerrarsesion()" class="btn btn-sm text-white">Cerrar sesión</button></label>
        @else
            <label class="font-gotham-medium color-secondary">No identificado</label>
        @endif
    </div>
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
                    <button id="btnasistencia" onclick="verificarLogin(1,this)" style="background-color:transparent;border:none;">
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
                    <button id="btnqr" onclick="verificarLogin(2,this)" style="background-color:transparent;border:none;">
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
                            <div class="h5 mb-0 font-gotham-bold text-center">Portal Colaborador</div>
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

<!-- Modal -->
<div class="modal fade" id="alertasistencia" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color:#0E5155;">
        <div class="modal-body text-center" id="bodynotificacion2" style="padding: 0;">
            <!--input id="idasistencia" class="form-input input" type="number" />
            <br>
            <div class="caja">
                <img class="fotoperfil" src="{{asset(Storage::url('app/'.$empleado->foto))}}">
            </div>
            <br>
            <p class="text-white font-gotham-book" style="font-size:20px">Carlos Alexander Miranda Oliva</p>
            <br>
            <p class="color-amarillo font-gotham-book" style="font-size:18px">Correlativo #</p>
            <p class="color-amarillo font-gotham-bold" style="font-size:28px">AE-0001</p>
            
            <p class="mt-2 text-white font-gotham-book" style="font-size:20px">Entrada</p>
            <p class="color-amarillo font-gotham-bold" style="font-size:35px">12:00 PM</p>
            
            <p class="mt-2 color-amarillo font-gotham-book" style="font-size:20px">Ingrese temperatura (°C)</p>
            <input id="inputtemperatura" class="form-input input" type="number" />

            <p class="mt-2 color-amarillo font-gotham-book" style="font-size:16px">¿Ha presentado algún sintoma de COVID-19?</p>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button id="btnasisnegativo" type="button" class="btn btn-success pl-5 pr-5"><i class="far fa-laugh"></i> NO</button>
                <button id="btnasispositivo" onclick="btnasispositivo('{{$empleado->toquen}}')" type="button" class="btn btn-warning pl-5 pr-5"><i class="far fa-tired"></i> SI</button>
            </div>
            <br>
            <br-->
        </div>
    </div>
  </div>
</div>
@stop
@section('script')
<script src="{{asset('js/instascan.js')}}"></script>
<script>
    function btnasisnegativo(){
        var temperatura = $("#inputtemperatura").val();
        if(temperatura.length>0){
            //Actualizar asistencia con la temperatura
            var idasistencia = $("#idasistencia").val();
            actualizarasistencia(idasistencia,temperatura,"no");
            $("#alertasistencia").modal('hide');
        }else{
            bootbox.alert({
                title:'Notificación',
                message:"Por favor ingrese la temperatura!!.",
                buttons:{
                    ok:{
                        label:'Cerrar'
                    }
                }
            });
        }
    }
    function btnasispositivo(toquen){
        var temperatura = $("#inputtemperatura").val();
        if(temperatura.length>0){
            //Actualizar asistencia con la temperatura
            var idasistencia = $("#idasistencia").val();
            actualizarasistencia(idasistencia,temperatura,"si");
            $("#alertasistencia").modal('hide');

            window.location="api/form/covid/"+toquen+"?temp="+temperatura;
        }else{
            bootbox.alert({
                title:'Notificación',
                message:"Por favor ingrese la temperatura!!.",
                buttons:{
                    ok:{
                        label:'Cerrar'
                    }
                }
            });
        }
    }
    function actualizarasistencia(idasistencia,temperatura,covid)
    {
        $.ajax({
            url:"{{route('asistencia.actualizar')}}",
            data:"idasistencia="+idasistencia+"&temp="+temperatura+"&covid="+covid,
            type:"GET",
            success:function(r){
                if(r==1){
                    $("#alertasistencia").modal('hide');
                }else{
                    bootbox.alert({
                        title:'Notificación',
                        message:"No se pudo registrar.",
                        buttons:{
                            ok:{
                                label:'Cerrar'
                            }
                        }
                    });
                }
            },
            error:function(){
                bootbox.alert({
                    title:'Notificación',
                    message:"No se pudo registrar.",
                    buttons:{
                        ok:{
                            label:'Cerrar'
                        }
                    }
                });
            }
        });
    }
    var dialogo;
    var dialogo2;
    var scanner;
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
    function cerrarsesion(){
        bootbox.confirm({ 
            size: "small",
            title:'Notificación',
            message: "¿Desea cerrar la sesión?",
            callback: function(result)
            {
                if(result==true){
                    $.ajax({
                        url:"{{route('cerrarsesion')}}",
                        type:"GET",
                        success:function(r){
                            //dialogo2.modal('hide');
                            //scanner.stop();
                            location.reload();
                        }
                    })
                }
            }
        });
    };
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

    function verificarLogin(id,div)
    {
        //inhabilita boton por 2 segundos para evitar mas de un clic
        $(div).prop("disabled",true);
        setTimeout(function(){
            $(div).prop("disabled",false);
        }, 2000);
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
                }else if(r==1){
                    if(id==1){
                        //Marcar asistencia
                        asistencia();
                    }else if(id==2){
                        //Abrir lector QR
                        window.location = "{{route('lectorqr',['b'=>$empleado->toquen])}}";
                    }
                }else if(r==2){
                    alert("Entro");
                    //escanearCarnet(id);
                }
            },error:function(){
                bootbox.alert('Error al conectar');
            }
        })
        
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
                        //Empleado esta asignado
                        if(id==1){
                            //Marcar asistencia
                            dialogo.modal('hide');
                            asistencia();
                        }else if(id==2){
                            //Abrir lector QR
                            window.location = "{{route('lectorqr',['b'=>$empleado->toquen])}}";
                        }
                    }else if(r==2){
                        //Empleado no esta asignado
                        //bootbox.alert('Empleado no asignado!');
                        escanearCarnet(id);
                    }else{
                        alertify.error(r+"!!");
                    }
                }
            });
        }
    }
    function escanearCarnet(id)
    {
        $(document).ready(function(){
            dialogo2 = bootbox.dialog({
                title:"Notificación",
                message:"<h6 class='text-center'>Al parecer, es primera vez que inicias sesión.<br> Como ultimo paso escanea el codigo QR del carnet de la empresa poder utilizar el portal</h6><div class='row'><hr><div ><video style='width:90%;margin-left:5%' id='preview' class='video' playsinline></video></div></div><div class='text-center'><button onclick='cerrarsesion()' class='btn btn-sm btn-danger'>Cerrar Sesión</button></div>",
                closeButton:false
            });
            scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 3, mirror:false });
            Instascan.Camera.getCameras().then(function (cameras){
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            }
            else {
                            
            }
            }).catch (function(e){  

            });
            scanner.addListener('scan',function(content)
            {
                $.ajax({
                    url:"{{route('escanearCarnet')}}",
                    type:"get",
                    data:"contenido="+content,
                    success:function(r)
                    {
                        if(r==1)
                        {
                            if(id==1){
                                //Marcar asistencia
                                dialogo.modal('hide');
                                dialogo2.modal('hide');
                                asistencia();
                            }else if(id==2){
                                //Abrir lector QR
                                window.location = "{{route('lectorqr',['b'=>$empleado->toquen])}}";
                            }
                        }else{
                            bootbox.dialog({
                                title:"Notificación",
                                message:r,
                                buttons:{
                                    ok:{
                                        label:"Ok"
                                    }
                                }
                            });
                        }
                    }
                });
            });
        });
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
                }else if(json['id']==44){
                    $("#bodynotificacion2").html(json['mensaje']);
                    $("#alertasistencia").modal('show');
                }else if(json['id']==45){
                    $("#bodynotificacion2").html(json['mensaje']);
                    $("#alertasistencia").modal('show');
                    window.setTimeout(ocultarAsistencia,2000);
                }
                if(json['id']!=44 && json['id']!=45){
                    $("#bodynotificacion").html(json['mensaje']);
                    $("#notificacion").modal('show');
                }
            }
        });
    }
    function ocultarAsistencia(){
        $("#alertasistencia").modal('hide');
    }
</script>
@stop