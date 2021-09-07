@extends('plantillaQR')
@section('pagina')
<form id="frmescaner" action="#" method="POST">
<div hidden>
    Latitud<input type="text" id="latitud" name="latitud" value="0"/>
    Longitud<input type="text" id="longitud" name="longitud" value="0"/>
    idUsuario <input type="text" id="idusuario" name="idusuario" value="{{$empleado->idusuario}}"/>
    idvehiculo<input type="text" id="idvehiculo" name="idvehiculo" value="{{$idvehiculo}}"/>
    contenido<input type="text" id="contenido"  name="contenido" />
</div>
<div class="row">
    <div class="col-12 text-center pt-2">
        <label class="font-gotham-medium color-secondary">Ubicación</label>
        <select class="input" id="idubicacion" name="idubicacion">
        @if($ubicacion)
          <option value="{{$ubicacion->id}}">{{$ubicacion->descripcion}}</option>
        @else
          <option value="0">Escanear QR</option>
        @endif
        </select>
    </div>
</div>
<div class="row">
  <div class="col-12 text-center pt-2">
    <label class="font-gotham-medium color-secondary">Codigo Carnet </label>
        <select class="input" id="idempleado" name="idempleado">
          @if ($empleado)
            <option value="{{$empleado->id}}">{{$empleado->codigo}}</option>
          @endif
          <option value="0">Escanea QR</option>
        </select>
  </div>
</div>
<div class="row pt-3 pb-3 mt-3">
    <div class="col-12 text-center color-secondary">
        <label class="font-gotham-medium color-secondary h5 pb-3">Selecciona una opción</label>
        <div class="form-check form-group">
          <input class="form-check-input" type="radio" name="opcion" id="asistencia" value="asistencia" checked>
          <label class="form-check-label h6" for="asistencia">
            Marcar asistencia
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="opcion" id="vehiculo" value="vehiculo">
          <label class="form-check-label h6" for="vehiculo">
            Utilizar vehiculo&nbsp;&nbsp;
          </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="cajaVideo">
        <video id="preview" class="video" playsinline></video>
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
        </div>
    </div>
  </div>
</div>

</form>
@stop
@section('script')
<script src="{{asset('js/instascan.js')}}"></script>
<script src="{{asset('js/buzz.min.js')}}"></script>
<script>  
  $(document).ready(function(){
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
          alertify.alert('Tu navegador no soporta la Geolocalización en HTML5');
      }
    
      //METODO PARA OBTENER LA UBICACION EN LA BD DE ACUERDO A LAS COORDENADS OBTENIDAS
      function obtenerUbicacion(lat,lon){
          $("#latitud").val(lat);
          $("#longitud").val(lon);
          var datos = {latitud:lat,longitud:lon};
          $.ajax({
              url:"{{route('api.getUbicacion')}}",
              type:"get",
              data: datos,
              success:function(r)
              {
                  var json = JSON.parse(r);
                  var contador = 0;
                  $("#idubicacion").empty();
                  $.each(json,function(e,key){
                      contador++;
                      $("#idubicacion").append('<option value="'+key.id+'">'+key.descripcion+'</option>');
                  });
              }
          });
      }
    $("#notificacion").on('hide.bs.modal',function(){
      Instascan.Camera.getCameras().then(function(cameras){
        if (cameras.length > 0){
          scanner.start(cameras[0]);
        }
        else {
                      
        }
      }).catch (function(e){

      });
    });
    $("#alertasistencia").on('hide.bs.modal',function(){
      Instascan.Camera.getCameras().then(function(cameras){
        if (cameras.length > 0){
          scanner.start(cameras[0]);
        }
        else {
                      
        }
      }).catch (function(e){

      });
    });
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 3, mirror:false });
    var lector = new buzz.sound("{{asset('sound/lector')}}", {formats: [ "mp3"]});
    scanner.addListener('scan',function(content)
    {
      lector.play().bind("lector", function() {});
      $("#contenido").val(content);
      $("#frmescaner").submit();
    });
    $("#frmescaner").bind('submit',function(){
      var datos = $(this).serialize();
      var datos = datos+"&_token={{csrf_token()}}";
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
            $("#idubicacion").append('<option value="0">Escanea QR</option>');
            $("#asistencia").prop("checked",true);
          }else if(json['id']==2){
            $("#bodynotificacion").html(json['mensaje']);
            $("#idempleado").empty();
            var jsonEmpleado = JSON.parse(json['json']);
            $("#idempleado").append('<option value="'+jsonEmpleado['id']+'">'+jsonEmpleado['nombre']+'</option>');
            $("#idempleado").append('<option value="0">Escanea QR</option>');
          }else if(json['id']==3){
            $("#bodynotificacion").html(json['mensaje']);
            $("#idvehiculo").val(json['idvehiculo']);
            $("#vehiculo").prop("checked",true);
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
          scanner.stop();
        }
      });
      return false;
    });
    Instascan.Camera.getCameras().then(function (cameras){
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      }
      else {
                    
      }
    }).catch (function(e){  

    });
  });
  function ocultarAsistencia(){
    $("#alertasistencia").modal('hide');
  }
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
</script>
@stop