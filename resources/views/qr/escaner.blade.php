@extends('plantillaQR')
@section('pagina')
<div hidden>
    <input id="cant" value="0"/>
    <input id="latitud" value="{{$latitud}}"/>
    <input id="longitud" value="{{$longitud}}"/>
    <input id="idusuario" value="1"/>
    <input id="idubicacion" value="76AE"/>
</div>
<div class="row">
    <div class="col-12 text-center pt-2">
        <label class="font-gotham-medium color-secondary">Carnet </label>
        <select class="input" id="idempleado">
            <option value="{{$empleado->id}}">{{$empleado->codigo}}</option>
        </select>
    </div>
</div>
<div class="row pt-3">
    <div class="col-12 text-center">
        <label class="font-gotham-medium color-secondary">Escanea el codigo QR</label>
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
@stop
@section('script')
<script src="{{asset('js/instascan.js')}}"></script>
<script src="{{asset('js/buzz.min.js')}}"></script>
<script>
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
  var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 3, mirror:false });
  var lector = new buzz.sound("{{asset('sound/lector')}}", {formats: [ "mp3"]});
  scanner.addListener('scan',function(content){
    lector.play().bind("lector", function() {});
    var token = '{{csrf_token()}}';
    var user = $("#idusuario").val();
    var la = $("#latitud").val();
    var lo = $("#longitud").val();
    var ubicacion = $("#idubicacion").val();
    var empleado = $("#idempleado").val();
    var datos = {contenido:content,_token:token,idusuario:user,idempleado:empleado,latitud:la,longitud:lo,idubicacion:ubicacion};
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
          cantidad.val(cantidad.val()+1);
        }else if(json['id']==2){
          $("#bodynotificacion").html(json['mensaje']);
          $("#idempleado").empty();
          var jsonEmpleado = JSON.parse(json['json']);
          $("#idempleado").append('<option value="'+jsonEmpleado['id']+'">'+jsonEmpleado['nombre']+'</option>');
          $("#idempleado").append('<option value="0">Seleccione</option>');
          cantidad.val(cantidad.val()+1);
        }
        $("#notificacion").modal('show');
        scanner.stop();
      }
    });
  });
  Instascan.Camera.getCameras().then(function (cameras){
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    }
    else {
                   
    }
  }).catch (function(e){  

  });
</script>
@stop