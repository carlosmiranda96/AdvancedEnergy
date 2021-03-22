@extends('plantilla')
@section('pagina')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-primary">Generales</h1>
  </div>

  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('inicio')}}">Pagina principal</a></li>
      <li class="breadcrumb-item active">Generales</li>
    </ol>
  </nav>

  <div class="row">
    <!-- Basic Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2 card-secondary">
        <a href="{{route('marcacionesempleados.index')}}" style="text-decoration: none;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold">Asistencia</div>
              </div>
              <div class="col-auto">
              <i class="fas fa-list-ol fa-3x"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2 card-secondary">
        <a href="{{route('equiposhistorial.index',session()->get('user_id'))}}" style="text-decoration: none;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold">Control vehiculos</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-truck fa-3x"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
@stop