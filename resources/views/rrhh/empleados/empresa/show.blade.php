@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Empleados</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('empleados.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspInformación de empleado</h6>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-xl-2">
                        <div class="row mb-3">
                            <div class="col-6 offset-3 col-lg-3 offset-lg-4 col-xl-12 offset-xl-0">
                            <img id="fotoperfil" width="100%" src="{{asset(Storage::url('app/'.$empleados->foto))}}" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10">
                        <h4 id="nombre" class="font-weight-bold text-primary">{{$empleados->nombreCompleto}}</h4>
                        <hr>
                        @include('rrhh/empleados/menu')
                        <div class="row">
                            <div class="col-12">
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
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
                                @if (session('mensaje'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('mensaje')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <h5 class="font-weight-bold text-primary">Ubicación de trabajo</h5>
                                <hr>
                            </div>
                            <div class="col-12">
                            <div class="form-group">
                                <a href="{{route('empleadoempresa.create',['id'=>$empleados->id])}}"><div class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Agregar</div></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Horario</th>
                                            <th>Cargo</th>
                                            <th>Salario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Horario</th>
                                            <th>Cargo</th>
                                            <th>Salario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($empleadoempresa as $item)
                                        <tr>
                                            <td><a href="{{ route('empleadoempresa.edit',$item->id)}}">{{$item->empresa}}</a></td>
                                            <td>{{$item->horario}}</td>
                                            <td>{{$item->cargo}}</td>
                                            <td>$ {{number_format($item->salario,'2')}}</td>
                                            <td>
                                                <form id="frmeliminar{{$item->id}}" method="post" action="{{route('empleadoempresa.destroy',$item->id)}}" class="form-inline">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-sm btn-warning" href="{{ route('empleadoempresa.edit',$item->id)}}"><i class="fas fa-edit"></i></a>
                                                <!--button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button-->
                                                <a onclick="eliminar('{{$item->id}}')" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if ($empleadoempresa->count()==0)
                                        <tr>
                                            <td colspan="5" class="text-center">No hay datos</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{$empleadoempresa->links()}}
                            </div>
                        </div>
                    </div>
                </div>
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
