@extends('plantilla')
@section('pagina')
<div class="container-fluid">
    <div hidden>
        <input id="cant" value="0"/>
        <input id="latitud" value="0"/>
        <input id="longitud" value="0"/>
        <input id="idusuario" value="{{session()->get('user_id')}}"/>
        <input id="idubicacion" value="76AE"/>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">Control vehiculos</h1>
            </div>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('inicio')}}">Pagina principal</a></li>
                <li class="breadcrumb-item"><a href="{{route('general')}}">Generales</a></li>
                <li class="breadcrumb-item active">Control vehiculos</li>
                </ol>
            </nav>
        </div>
        @if (session('mensaje'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
        <div class="card border-left-warning shadow h-100 py-2">
            <a href="{{route('equipos.index',session()->get('user_id'))}}" style="text-decoration: none;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Listado de vehiculos</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-list fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </a>
        </div>
        </div>

        <div class="col-12 pt-3">
        <div class="card border-left-warning shadow h-100 py-2">
            <a href="{{route('equipomantenimiento.index')}}" style="text-decoration: none;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Mantenimientos</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-list fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </a>
        </div>
        </div>

        <div class="col-12 pt-3">
        <div class="card border-left-warning shadow h-100 py-2">
            <a href="{{route('equipomantenimiento.programacion')}}" style="text-decoration: none;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Programar Mantenimientos</div>
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

</script>
@stop