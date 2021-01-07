@extends('plantilla')
@section('pagina')
    <div class='container-fluid'>
      <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Asistencia</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('marcacionesempleados.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspLista de asistencia</h6>
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
                <a href="{{route('marcacionesempleados.index')}}"><button class="btn btn-sm btn-primary"><i class="fas fa-qrcode fa-sm text-white-50"></i> Marcar asistencia</button></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo</th>
                            <th>Empleado</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo</th>
                            <th>Empleado</th>
                            <th>Ubicación</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($marcacionesempleados as $item)
                        <tr>
                            <td>{{date('d/m/Y',strtotime($item->instante))}}</td>
                            <td>{{date('h:i a',strtotime($item->instante))}}</td>
                            <td>@if ($item->tipo=="E") {{'ENTRADA'}} @else {{'SALIDA'}} @endif</td>
                            <td>{{$item->empleado}}</td>
                            <td>{{$item->ubicacion}}</td>
                        </tr>
                        @endforeach
                        @if ($marcacionesempleados->count()==0)
                        <tr>
                            <td colspan="5" class="text-center">No hay datos</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $marcacionesempleados->links() }}
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