@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de ubicaciones</h1>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ubicación {{$ubicacion->descripcion}}</h6>
                </div>
                <div class="card-body">
                    @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('mensaje')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="form-group">
                        <a href="{{route('ubicacion.index')}}"><button class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Atras</button></a>
                    </div>
                    <div class="form-group">
                        <label>Codigo</label>
                        <input disabled type="text"value="{{$ubicacion->codigo}}" class="form-control" autofocus autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input disabled type="text" name="placa" value="{{$ubicacion->descripcion}}" class="form-control" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Ubicación</label>
                        <div id='map' style='width: 100%; height: 400px;'></div>
                    </div>
                    <div class="row">
                    <div class="form-group col-6">
                        <label>Latitud</label>
                        <input disabled type="text" name="marca" value="{{$ubicacion->latitud}}" class="form-control" autocomplete="off"/>
                    </div>
                    <div class="form-group col-6">
                        <label>Longitud</label>
                        <input disabled type="text" name="marca" value="{{$ubicacion->longitud}}" class="form-control" autocomplete="off"/>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 text-center">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Codigo QR</h6>
                </div>
                <div class="card-body">
                    <center><div id="codigoQR"></div></center>
                    <a id="descargarCodigo"><button class="btn btn-primary mt-3"><i class="fas fa-download"></i> Descargar</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('head')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>
@stop
@section('script')
    <script src="{{asset('js/qrcode.min.js')}}"></script>
    <script>
        cargarMapa('{{$ubicacion->latitud}}','{{$ubicacion->longitud}}');
        var qrcode = new QRCode("codigoQR");
        qrcode.clear(); // clear the code.
        //qrcode.makeCode("https://maps.google.com/?q={{$ubicacion->latitud}},{{$ubicacion->longitud}}&ae={{$ubicacion->id}}");
        qrcode.makeCode("{{route('lectorqr',['c'=>$ubicacion->id])}}");
        $("#descargarCodigo").on("click",function(){
            var base64 = $("#codigoQR img").attr('src');
            $("#descargarCodigo").attr('href', base64);
            $("#descargarCodigo").attr('download', "codigoQR");
            $("#descargarCodigo").trigger("click");
        });
        function cargarMapa(la,lo){
            mapboxgl.accessToken = 'pk.eyJ1IjoiY2FybG9zbWlyYW5kYTk2IiwiYSI6ImNraHR5M251YzBxZHgydHBnemU4NnNkbXMifQ.uEth7efXtsIVczovpOXXJQ';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center:[lo,la],
                zoom:15
            });
            var nav = new mapboxgl.NavigationControl();
            map.addControl(nav, 'top-left');
            var marker = new mapboxgl.Marker({draggable:false}).setLngLat([lo,la]).addTo(map);
            marker.on('dragend',function(){
                var lngLat = marker.getLngLat();
                $("#latitud").val(lngLat.lat);
                $("#longitud").val(lngLat.lng);
            });
        }
    </script>
@stop