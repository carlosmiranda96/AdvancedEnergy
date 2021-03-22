@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de ubicaciones</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado de ubicaciones</h6>
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
                <a href="{{route('ubicacion.create')}}"><button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Agregar</button></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Ver mapa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Ver mapa</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($ubicacion as $item)
                        <tr class="fila">
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{$item->codigo}}</td>
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{$item->descripcion}}</td>
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{$item->latitud}}</td>
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{$item->longitud}}</td>
                            <td><a target="_blank" href="https://maps.google.com/?q={{$item->latitud}},{{$item->longitud}}">ver</a></td>
                            <td>
                                <form id="mostrar{{$item->id}}" action="{{ route('ubicacion.show',$item->id)}}" method="GET"></form>
                                <form id="frmeliminar{{$item->id}}" method="post" action="{{route('ubicacion.destroy',$item->id)}}" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" href="{{ route('ubicacion.edit',$item->id) }}"><i class="fas fa-edit"></i></a>
                                <!--button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button-->
                                <a onclick="eliminar('{{$item->id}}')" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($ubicacion->count()==0)
                        <tr>
                            <td colspan="5" class="text-center">No hay datos</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $ubicacion->links() }}
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
    function mostrar(key){
        $("#mostrar"+key).submit();
    }
</script>
@stop