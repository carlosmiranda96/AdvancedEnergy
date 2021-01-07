@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de usuarios</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nuevo usuario</h6>
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
            <form method="POST" action="{{route('usuarios.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="invitacion" name="invitacion" @if(old('invitacion')=="on") {{'checked'}} @endif>
                        <label class="custom-control-label" for="invitacion">Enviar como invitación</label>
                    </div>
                </div>
                <div id="divConfig">
                <div class="form-group">
                    <label>Rol</label>
                    <select class="form-control" name="idrol">
                        <option value="0" @if(old('idrol')=="0") {{'selected'}} @endif>Seleccione</option>
                        <option value="1" @if(old('idrol')=="1") {{'selected'}} @endif>Administrador</option>
                        <option value="2" @if(old('idrol')=="2") {{'selected'}} @endif>Usuario</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" value="{{old('password')}}" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Foto de perfil</label>
                    <div class="custom-file mb-3">
                        <input type="file" name="foto" value="{{old('foto')}}" class="custom-file-input" id="validatedCustomFile" accept="image/*">
                        <label class="custom-file-label" for="validatedCustomFile">Seleccione la imagen</label>
                        <div class="invalid-feedback">Imagen no valida</div>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <a href="{{route('usuarios.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
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