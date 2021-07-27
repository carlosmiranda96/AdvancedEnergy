@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de cargos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nuevo cargo</h6>
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
            <form method="POST" action="{{route('cargos.store')}}">
                @csrf
                <div class="form-group">
                    <label>Empresa</label>
                    <select class="form-control" id="idempresa" name="idempresa">
                        <option value="">Seleccione</option>
                        @foreach ($empresas as $emp)
                            <option value="{{$emp->id}}">{{$emp->nombreEmpresa}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Cargo</label>
                    <input type="text" name="cargo" value="{{old('cargo')}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Departamento</label>
                    <select class="form-control" id="idDepartamento" name="idDepartamento">
                        <option value="0">Seleccione</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{route('cargos.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
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
                    url:"{{route('departamento.empresa')}}",
                    success:function(r){
                        $("#idDepartamento").empty();
                        $("#idDepartamento").append('<option value="0">Seleccione</option>');
                        $.each(r,function(value,key){  
                            $("#idDepartamento").append('<option value="'+key.id+'">'+key.departamento+'</option>');
                        });
                    },
                    error:function(){
                        alert("Error");
                    },
                    beforeSend:function(){
                        $("#idDepartamento").empty();
                        $("#idDepartamento").append('<option value="">Cargando...</option>');
                        $("#idDepartamento").empty();
                        $("#idDepartamento").append('<option value="">Seleccione</option>');
                    }
                })
            }else{
                $("#idDepartamento").empty();
                $("#idDepartamento").append('<option value="">Seleccione</option>');
            }
        });
    </script>
@stop