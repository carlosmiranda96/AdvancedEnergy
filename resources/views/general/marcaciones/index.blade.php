@extends('plantilla')
@section('pagina')
<div class="container-fluid">
    <div hidden>
        <input id="cant" value="0"/>
        <input id="latitud" value="0"/>
        <input id="longitud" value="0"/>
        <input id="idusuario" value="{{session()->get('user_id')}}"/>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">Asistencia</h1>
            </div>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('inicio')}}">Pagina principal</a></li>
                <li class="breadcrumb-item"><a href="{{route('general')}}">Generales</a></li>
                <li class="breadcrumb-item active">Asistencia</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="text-primary">Ubicación</label>
                <select class="form-control text-danger" id="idubicacion">
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <h4 id="textoQR" class="text-primary text-center"></h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4">
            @include('qr.lectorqr')
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <a href="{{route('marcacionesempleados.show',session()->get('user_id'))}}" style="text-decoration: none;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Lista de asistencia</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-list fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </a>
        </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    var cantidad = $("#cant");
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
                    alertify.alert('Notificación GPS','La información de tu posición no es posible');
                    break;
                    //timeout al intentar obtener las coordenadas
                case objError.TIMEOUT:
                    alertify.alert('Notificación GPS','Tiempo de espera agotado');
                    break;
                    //el usuario no desea mostrar la ubicacion
                case objError.PERMISSION_DENIED:
                    alertify.alert('Notificación GPS','Necesitas permitir tu localización');
                    break;
                    //errores desconocidos
                case objError.UNKNOWN_ERROR:
                    alertify.alert('Notificación GPS','Error desconocido');
                    break;
            }
        });
    }else{
        //el navegador del usuario no soporta el API de Geolocalizacion de HTML5
        alertify.alert('Tu navegador no soporta la Geolocalización en HTML5');
    }
    function obtenerUbicacion(lat,lon){
        var datos = {latitud:lat,longitud:lon};
        $.ajax({
            url:"{{route('getUbicacion')}}",
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
                cantidad.val(contador)
                if(contador==0){
                    $("#textoQR").html('Escanea codigo QR de tu ubicación');
                }else if(contador<=1){
                    $("#textoQR").html('Escanea codigo QR de tu ubicación');
                }else if(contador<=2){
                    $("#textoQR").html('Escanea codigo QR del carnet');
                }else{
                    $("#textoQR").html('Selecciona tu ubicación o escanea QR');
                }
            }
        });
    }
    $("#idubicacion").on("change",function(){
        if($(this).val()==0){
            if(cantidad.val()>2){
                $("#textoQR").html('Selecciona tu ubicación o escanea QR');
            }else{
                $("#textoQR").html('Escanea codigo QR de tu ubicación');
            }
        }else{
            $("#textoQR").html('Escanea codigo QR del carnet');
        }
    });
</script>
@stop