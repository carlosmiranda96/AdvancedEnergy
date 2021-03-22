@extends('plantilla')
@section('pagina')
    <div class='container-fluid'>
      <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Control de vehiculos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('equiposhistorial.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspHistorial de vehiculos</h6>
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
                <a href="{{route('equiposhistorial.index')}}"><button class="btn btn-sm btn-primary"><i class="fas fa-qrcode fa-sm text-white-50"></i> Lector QR</button></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Vehiculo</th>
                            <th>Empleado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Vehiculo</th>
                            <th>Empleado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($equiposhistorial as $item)
                        <tr class="fila">
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{date('d/m/Y',strtotime($item->instante))}}</td>
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{date('h:i a',strtotime($item->instante))}}</td>
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{ $item->codigo.' '.$item->placa.' '.$item->marca}}</td>
                            <td onclick="mostrar('{{$item->id}}')" style="cursor:pointer">{{$item->empleado}}</td>
                            <td>
                                <form id="mostrar{{$item->id}}" action="{{ route('equiposhistorial.mostrar',$item->id)}}" method="GET"></form>
                                <form id="frmeliminar{{$item->id}}" method="post" action="{{route('empleados.destroy',$item->id)}}" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" href="{{ route('equiposhistorial.edit',$item->id) }}"><i class="fas fa-edit"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($equiposhistorial->count()==0)
                        <tr>
                            <td colspan="5" class="text-center">No hay datos</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $equiposhistorial->links() }}
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