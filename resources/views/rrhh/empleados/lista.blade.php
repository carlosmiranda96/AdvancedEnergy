@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Empleados</h1>
    </div>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}">Pagina principal</a></li>
        <li class="breadcrumb-item"><a href="{{route('rrhh')}}">RRHH</a></li>
        <li class="breadcrumb-item active">Empleados</li>
        </ol>
    </nav>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('rrhh')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspListado de empleados</h6>
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
                <a href="{{route('empleados.create')}}"><button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Agregar</button></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha ingreso</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Fecha ingreso</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($empleados as $item)
                        <tr>
                            <td>{{date('d/m/Y',strtotime($item->fechaingreso))}}</td>
                            <td>{{$item->codigo}}</td>
                            <td><a href="{{ route('empleados.edit',$item->id) }}">{{$item->nombreCompleto}}</a></td>
                            <td>
                                <form id="frmeliminar{{$item->id}}" method="post" action="{{route('empleados.destroy',$item->id)}}" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" href="{{ route('empleados.edit',$item->id) }}"><i class="fas fa-edit"></i></a>
                                <!--button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button-->
                                <a onclick="eliminar('{{$item->id}}')" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($empleados->count()==0)
                        <tr>
                            <td colspan="4" class="text-center">No hay datos</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $empleados->links() }}
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    function eliminar(key){
        alertify.confirm("Notificación","¿Desea eliminar el registro?",function(){
            $("#frmeliminar"+key).submit();
        },function(){

        });
    }
</script>
@stop