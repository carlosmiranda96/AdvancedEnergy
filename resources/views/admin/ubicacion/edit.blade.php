@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de ubicaciones</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Actualizar ubicación</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form method="POST" action="{{route('ubicacion.update',$ubicacion->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Codigo</label>
                    <input type="text" name="codigo" value="{{$ubicacion->codigo}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" name="descripcion" value="{{$ubicacion->descripcion}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Ubicación</label>
                    <div id='map' style='width: 100%; height: 400px;'></div>
                </div>
                <div class="row">
                <div class="form-group col-6">
                    <label>Latitud</label>
                    <input type="text" id="latitud" name="latitud" value="{{$ubicacion->latitud}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group col-6">
                    <label>Longitud</label>
                    <input type="text" id="longitud" name="longitud" value="{{$ubicacion->longitud}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                </div>
                <div class="form-group">
                    <a href="{{route('ubicacion.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('head')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>
@stop
@section('script')
<script>
    $(document).ready(function(){
        cargarMapa('{{$ubicacion->latitud}}','{{$ubicacion->longitud}}');
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
        var marker = new mapboxgl.Marker({draggable:true}).setLngLat([lo,la]).addTo(map);
        marker.on('dragend',function(){
            var lngLat = marker.getLngLat();
            $("#latitud").val(lngLat.lat);
            $("#longitud").val(lngLat.lng);
        });
    }
</script>
@stop