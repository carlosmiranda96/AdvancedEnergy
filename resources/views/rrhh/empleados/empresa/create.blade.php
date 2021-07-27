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
            <form id="frmempleado" method="POST" action="{{route('empleadoempresa.store')}}" enctype="multipart/form-data">
                @csrf
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
                                <h5 class="font-weight-bold text-primary">Nueva ubicación de trabajo</h5>
                                <hr>
                            </div>
                            <input hidden type="text" class="form-control" name="idempleado" value="{{$empleados->id}}" required/>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Empresa <span class="text-danger">*</span></label>
                                    <select class="form-control" id="idempresa" name="idempresa" autofocus required>
                                        <option value="0">Seleccione</option>
                                        @foreach($empresas as $item)
                                        <option value="{{$item->id}}">{{$item->nombreEmpresa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Horario <span class="text-danger">*</span></label>
                                    <select class="form-control" name="idgrupohorario" required>
                                        <option value="0">Seleccione</option>
                                        @foreach($horario as $item)
                                        <option @if(old('idgrupohorario')==$item->id) {{'selected'}} @endif value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cargo <span class="text-danger">*</span></label>
                                    <select class="form-control" id="idcargo" name="idcargo" required>
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Salario</label>
                                    <input value="{{old('salario')}}" type="text" class="form-control" name="salario"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="1" name="horasextras">
                                        <label class="form-check-label" for="inlineCheckbox3">Aplica a horas extras</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <a href="{{route('empleadoempresa.show',$empleados->id)}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $("#idempresa").on("change",function(){
            if(this.value){
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:"idempresa="+$(this).val(),
                    url:"{{route('cargos.empresa')}}",
                    success:function(r){
                        $("#idcargo").empty();
                        $("#idcargo").append('<option value="0">Seleccione</option>');
                        $.each(r,function(value,key){  
                            $("#idcargo").append('<option value="'+key.id+'">'+key.cargo+'</option>');
                        });
                    },
                    error:function(){
                        alert("Error");
                    },
                    beforeSend:function(){
                        $("#idcargo").empty();
                        $("#idcargo").append('<option value="">Cargando...</option>');
                        $("#idcargo").empty();
                        $("#idcargo").append('<option value="">Seleccione</option>');
                    }
                })
            }else{
                $("#idcargo").empty();
                $("#idcargo").append('<option value="">Seleccione</option>');
            }
        });
    </script>
@stop