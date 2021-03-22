@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de grupo</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado de grupo</h6>
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
                <a href="{{route('grupo.create')}}"><button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Agregar</button></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($grupo as $item)
                        <tr>
                            <td>{{$item->grupo}}</td>
                            <td>
                                <form id="frmeliminar{{$item->id}}" method="post" action="{{route('grupo.destroy',$item->id)}}" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" href="{{ route('grupo.edit',$item->id) }}"><i class="fas fa-edit"></i></a>
                                <a onclick="eliminar('{{$item->id}}')" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($grupo->count()==0)
                        <tr>
                            <td colspan="5" class="text-center">No hay datos</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $grupo->links() }}
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
    function restablecer(key)
    {
        bootbox.dialog({
            title:"Notificación",
            message:"¿Desea enviar correo para restablecer contraseña?",
            buttons:{
                confirm:{
                    label:"SI",
                    className:"btn-success",
                    callback:function(){
                        $.ajax({
                            url:"{{route('usuario.restablecer')}}",
                            type:"POST",
                            data:"_token={{csrf_token()}}&id="+key,
                            success:function(r){
                                bootbox.alert({
                                    title:"Notificación",
                                    message:r
                                });
                            }
                            ,error:function(){
                                bootbox.alert("Error ");
                            }
                        });
                    }
                },
                cancel:{
                    label:"NO",
                    className:"btn-danger"
                }
            }
        });
    }
</script>
@stop