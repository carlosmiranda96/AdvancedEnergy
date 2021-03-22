@extends('plantilla')
@section('pagina')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Control de vehiculos</h1>
    </div>
    <div class="row">
      <div class="col-xl-6">
    <div class="card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('equiposhistorial.show',session()->get('user_id'))}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspFormulario</h6>
        </div>
        <div class="card-body">
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
        @if($disabled!="")
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            Formulario ya fue completado
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="row">
          <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <img width="100%" src="{{asset('img/logoverde2.png')}}">
          </div>
          <ul class="col-12 ml-3">
            <p class="font-weight-bold">Condiciones Generales Vehículos</p>
            <li class="font-weight-normal font-12">No Fumar</li>
            <li class="font-weight-normal font-12">No pasar los limites de velocidad establecidos y/o 90 km/h</li>
            <li class="font-weight-normal font-12">No llevar a personas ajenas a la empresa </li>
            <li class="font-weight-normal font-12">Verificar equipo de seguridad, triangulo y extinguido entre otros.</li>
            <li class="font-weight-normal font-12">Verificar que cuente con botiquín</li>
            <li class="font-weight-normal font-12">Verificar que cuente con atomizador</li>
            <li class="font-weight-normal font-12">Verificar que cuente con alcohol gel</li>
            <li class="font-weight-normal font-12">DESINFECTAR después de cada turno</li>
            <li class="font-weight-normal font-12">Contar con tarjeta de circulación y carnet o sticker de seguro</li>
            <li class="font-weight-normal font-12">Usar mascarilla dentro del vehículo</li>
            <li class="font-weight-normal font-12">Prohibido consumir bebidas alcohólicas</li>
            <li class="font-weight-normal font-12">NO dejar basura</li>
          </ul>
        </div>        
        <form id="frmvehiculo" method="POST" action="{{route('equiposhistorial.update',$equipohistorial->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label>Especifique el uso <span class="text-danger">*</span></label>
          <select class="form-control" name="uso" autofocus required {{$disabled}}>
            <option @if(old('uso')=='0') {{'selected'}} @endif value="0">Seleccione</option>
            <option @if(old('uso')=='Oficina') {{'selected'}} @endif value="Oficina">Oficina</option>
            <option @if(old('uso')=='Proyecto') {{'selected'}} @endif value="Proyecto">Proyecto</option>
            <option @if(old('uso')=='Operación y mantenimiento') {{'selected'}} @endif value="Operación y mantenimiento">Operación y mantenimiento</option>
            <option @if(old('uso')=='Personal') {{'selected'}} @endif value="Personal">Personal</option>
            <option @if(old('uso')=='Devolución') {{'selected'}} @endif value="Devolución">Devolución</option>
          </select>
        </div>
        <div class="form-group">
          <label>Kilometraje <span class="text-danger">*</span></label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
            <input type="number" class="form-control" value="{{old('kilometraje')}}" {{$disabled}} name="kilometraje"/>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto" {{$disabled}} id="inputGroupFile03" aria-describedby="inputGroupFileAddon03">
              <label class="custom-file-label" for="inputGroupFile03" data-browse="Foto"></label>
            </div>
          </div>
          <img hidden id="fotoperfil" src="#" class="img-thumbnail col-12 col-xl-4 offset-xl-4">
        </div>
        <div class="form-group">
          <label>Combustible <span class="text-danger">*</span></label>
          <select class="form-control" name="combustible" {{$disabled}}>
            <option @if(old('combustible')=='0') {{'selected'}} @endif value="0">Seleccione</option>
            <option @if(old('combustible')=='1/4') {{'selected'}} @endif value="1/4">1/4</option>
            <option @if(old('combustible')=='1/3') {{'selected'}} @endif value="1/3">1/3</option>
            <option @if(old('combustible')=='1/2') {{'selected'}} @endif value="1/2">1/2</option>
            <option @if(old('combustible')=='7/8') {{'selected'}} @endif value="7/8">7/8</option>
            <option @if(old('combustible')=='LLENO') {{'selected'}} @endif value="LLENO">LLENO</option>
          </select>
        </div>
        <label>Marque el equipo que posee el vehiculo</label>
        <div class="form-group">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="extinguidor" {{$disabled}}>
            <label class="form-check-label" for="inlineCheckbox1">Extinguidor</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="1" name="botiquin" {{$disabled}}>
            <label class="form-check-label" for="inlineCheckbox2">Botiquin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="1" name="equiposeguridad" {{$disabled}}>
            <label class="form-check-label" for="inlineCheckbox3">Triangulo</label>
          </div>
        </div>
        <div class="form-group">
          <label>Cualquier duda o sugerencia escribirla a continuación</label>
          <textarea class="form-control" name="observaciones" {{$disabled}}></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary col-12" {{$disabled}}><i class="fas fa-check"></i> Finalizar</button>
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
    
  function filePreview(input) {
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#frmvehiculo + img').remove();
                    $("#fotoperfil").prop("hidden",false);
                    $("#fotoperfil").attr("src",e.target.result);
                }
            }
        }
        $("#foto").change(function () {
            filePreview(this);
        });
  </script>
@stop