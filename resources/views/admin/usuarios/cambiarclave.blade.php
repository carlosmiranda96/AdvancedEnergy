@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de usuarios</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cambiar clave de {{$usuarios->name}}</h6>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
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
            <form method="POST" action="{{route('usuarios.updateclave',$usuarios->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Clave</label>
                    <input type="password" name="password" id="password" value="" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Repetir clave</label>
                    <input type="password" name="password2" id="password2" onkeyUp="verificar(this)" value="" class="form-control" autocomplete="off"/>
                    <div class="invalid-feedback">
                        Clave ingresada no coincide
                    </div>
                    @if(isset($perfil))
                    <input hidden type="text" name="perfil" value="1" class="form-control"/>
                    @endif
                </div>
                <div class="form-group">
                    @if(isset($perfil))
                    <a href="{{route('aj_perfil')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                    @else
                    <a href="{{route('usuarios.edit',$usuarios->id)}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        function verificar(input)
        {
            if($(input).val()!=$("#password").val())
            {
                $(input).addClass('is-invalid');
            }else{
                $(input).removeClass('is-invalid');
            }
        }
    </script>
@stop