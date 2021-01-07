@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Perfil</h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Actualizar usuario</h6>
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
            <form id="actualizarFoto" method="POST" action="{{route('perfil.update',$usuarios->id)}}" enctype="multipart/form-data" >
                @method('PUT')
                @csrf
                <div class="col-6 offset-3 col-lg-3 offset-lg-4 col-xl-2 offset-xl-5">
                    <img id="fotoperfil" width="100%" src="{{asset(Storage::url('app/'.$usuarios->foto))}}" class="img-thumbnail">
                    <div class="custom-file mb-3" style="cursor:pointer;">
                        <input type="file" id="foto" name="foto" value="{{old('foto')}}" class="custom-file-input" id="validatedCustomFile" accept="image/*">
                        <button class="col-12 btn btn-sm btn-secondary" style="position:absolute;left:0;"><i class="fas fa-upload"></i> Cambiar foto</button>
                    </div>
                </div>
            </form>
            <form method="POST" action="{{route('perfil.update',$usuarios->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" value="{{$usuarios->name}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="text" name="email" value="{{$usuarios->email}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <a href="{{route('usuarios.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <a href="{{route('usuarios.clave',$usuarios->id)}}"><div class="btn btn-sm btn-primary"><i class="fas fa-key"></i> Cambiar clave</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $("#foto").on("change",function()
        {
            $("#actualizarFoto").submit();
        });
        $('#actualizarFoto').submit(function (ev) {
            $.ajax({
                type: $('#actualizarFoto').attr('method'), 
                url: $('#actualizarFoto').attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (data)
                {
                    $("#fotoperfil").attr("src",'/advanced/storage/app/'+data);
                }
            });
            ev.preventDefault();
        });
    </script>
@stop