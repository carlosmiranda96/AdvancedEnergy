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
                    <form id="frmempleado" method="POST" action="{{route('empleadodocumento.update',$empleadodocumento->id)}}">
                        @csrf
                        @method('PUT')
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
                                <h5 class="font-weight-bold text-primary">Editar documento</h5>
                                <hr>
                            </div>
                            <input hidden type="text" class="form-control" name="idempleado" value="{{$empleados->id}}" required/>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tipo documento <span class="text-danger">*</span></label>
                                    <select class="form-control" name="idtipodocumento" autofocus required>
                                        <option value="0">Seleccione</option>
                                        @foreach($tipodocumento as $item)
                                        <option @if ($empleadodocumento->idtipodocumento==$item->id) {{'selected'}} @endif value="{{$item->id}}">{{$item->tipodocumento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Número de documento <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$empleadodocumento->numerodocumento}}" name="numerodocumento" required/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Fecha expedición</label>
                                    <input type="date" class="form-control" value="{{$empleadodocumento->fechaexpedicion}}" name="fechaexpedicion"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Fecha vencimiento</label>
                                    <input type="date" class="form-control" value="{{$empleadodocumento->fechavencimiento}}" name="fechavencimiento"/>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="row">
                        <div class="col-12 mt-2">
                            <h5 class="font-weight-bold text-primary">Adjuntos</h5>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div id="uploaded_image">
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <form id="dropzoneForm" class="dropzone" action="{{route('empleadodocumento.subiradjunto')}}">
                            @csrf
                            <div class="dz-message" data-dz-message><span>Arrastra los archivos aquí</span></div>
                            <input hidden type="text" name="empleadodocumentoid" value="{{$empleadodocumento->id}}">
                            </form>
                            <div align="center" class="mt-3">
                                <button type="button" class="btn btn-primary" id="submit-all">Subir</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <a href="{{route('empleadodocumento.show',$empleados->id)}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                                <button id="btnactualizar" class="btn btn-sm btn-warning"><i class="fas fa-save"></i> Actualizar</button>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.css')}}" />
@stop
@section('script')
<script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
<script>
    $("#btnactualizar").click(function(){
        $("#frmempleado").submit();
    });
    Dropzone.options.dropzoneForm = {
    autoProcessQueue : false,
    acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg,.pdf",
    init:function(){
      var submitButton = document.querySelector("#submit-all");
      myDropzone = this;
 
      submitButton.addEventListener('click', function(){
        myDropzone.processQueue();
      });
 
      this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          var _this = this;
          _this.removeAllFiles();
        }
        load_images();
      });
 
    }
 
  };
 
  load_images();
 
  function load_images()
  {
    $.ajax({
      url:"{{route('empleadodocumento.listaadjunto')}}",
      data:"idempleadodocumento={{$empleadodocumento->id}}",
      success:function(data)
      {
        $('#uploaded_image').html(data);
      }
    })
  }
 
  $(document).on('click', '.remove_image', function(){
    var name = $(this).attr('id');
    $.ajax({
      url:"{{route('empleadodocumento.borraradjunto')}}",
      data:{id : name},
      success:function(data){
        load_images();
      }
    })
  });
</script>
@stop