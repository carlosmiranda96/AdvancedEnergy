@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de autorizacion
        </h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Autorizaciones de {{$usuario->name}}</h6>
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
            <form method="POST" action="{{route('autorizacion.update',$usuario->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Permisos</label>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Modulo</th>
                                    <th>Permiso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $item)
                                <tr>
                                    <td>{{$item->modulo}}</td>
                                    <td>{{$item->nombre}}</td>
                                    <td class="text-center"> 
                                        <div class="form-check">
                                            <input @if(in_array($item->id,$arreglo)) {{'checked'}} @endif class="form-check-input" type="checkbox" value="{{$item->id}}" name="permiso[]"> 
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if ($permisos->count()==0)
                                <tr>
                                    <td colspan="2" class="text-center">No hay datos</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{route('autorizacion.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop