@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de empresas</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nueva empresa</h6>
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
            <form id="frmempresa" method="POST" action="{{route('empresa.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4 col-lg-3 col-xl-2">
                        <img id="logo" width="100%" src="{{asset(Storage::url('app/fotoempresa/logo.png'))}}" class="img-thumbnail">
                        <div class="custom-file mb-3" style="cursor:pointer;">
                            <input type="file" id="foto" name="foto" value="{{old('foto')}}" class="custom-file-input" id="validatedCustomFile" accept="image/*">
                            <div class="col-12 btn btn-sm btn-secondary" style="position:absolute;left:0;"><i class="fas fa-upload"></i> Cambiar foto</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nombre de empresa</label>
                    <input type="text" name="nombreEmpresa" value="{{old('nombreEmpresa')}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Color #1</label>
                            <input type="text" name="color1" value="{{old('color1')}}" class="form-control" autofocus autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Color #2</label>
                            <input type="text" name="color2" value="{{old('color2')}}" class="form-control" autofocus autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Color #3</label>
                            <input type="text" name="color3" value="{{old('color3')}}" class="form-control" autofocus autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{route('empresa.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        function filePreview(input) {
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#frmempresa + img').remove();
                    $("#logo").attr("src",e.target.result);
                }
            }
        }
        $("#foto").change(function () {
            filePreview(this);
        });
    </script>
@stop