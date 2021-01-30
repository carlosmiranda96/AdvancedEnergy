@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de grupo</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nuevo grupo</h6>
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
            <form method="POST" action="{{route('grupo.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Grupo</label>
                    <input type="text" name="grupo" value="{{old('grupo')}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <a href="{{route('grupo.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        var enviar = false;
        if($("#invitacion").attr("checked")){
            if(enviar==false){
                enviar=true;
                $("#divConfig").hide();
            }else{
                enviar=false;
                $("#divConfig").show();
            }
        }
        $("#invitacion").click(function(){
            if(enviar==false){
                enviar=true;
                $("#divConfig").hide();
            }else{
                enviar=false;
                $("#divConfig").show();
            }
        });
    </script>
@stop