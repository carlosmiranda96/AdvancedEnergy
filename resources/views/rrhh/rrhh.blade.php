@extends('plantilla')
@section('pagina')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Recursos humanos</h1>
    </div>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}">Pagina principal</a></li>
        <li class="breadcrumb-item active">RRHH</li>
        </ol>
    </nav>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <a href="{{ route('empleados.index')}}" style="text-decoration: none;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <!--div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Marcaciones</div-->
                            <div class="h5 mb-0 font-weight-bold text-primary">Empleados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-qrcode fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>
@stop