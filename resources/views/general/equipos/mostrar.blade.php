@extends('plantilla')
@section('pagina')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Control de vehiculos</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
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
                <div class="form-group">
                <label>Especifique el uso <span class="text-danger">*</span></label>
                <select class="form-control" name="uso" autofocus disabled>
                    <option @if($equipohistorial->uso=='0') {{'selected'}} @endif value="0">Seleccione</option>
                    <option @if($equipohistorial->uso=='Oficina') {{'selected'}} @endif value="Oficina">Oficina</option>
                    <option @if($equipohistorial->uso=='Proyecto') {{'selected'}} @endif value="Proyecto">Proyecto</option>
                    <option @if($equipohistorial->uso=='Operación y mantenimiento') {{'selected'}} @endif value="Operación y mantenimiento">Operación y mantenimiento</option>
                    <option @if($equipohistorial->uso=='Personal') {{'selected'}} @endif value="Personal">Personal</option>
                    <option @if($equipohistorial->uso=='Devolución') {{'selected'}} @endif value="Devolución">Devolución</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Kilometraje <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" value="{{$equipohistorial->kilometraje}}" name="kilometraje" disabled/>
                </div>
                <div class="form-group">
                <label>Combustible <span class="text-danger">*</span></label>
                <select class="form-control" name="combustible" disabled>
                    <option @if($equipohistorial->combustible=='0') {{'selected'}} @endif value="0">Seleccione</option>
                    <option @if($equipohistorial->combustible=='1/4') {{'selected'}} @endif value="1/4">1/4</option>
                    <option @if($equipohistorial->combustible=='1/3') {{'selected'}} @endif value="1/3">1/3</option>
                    <option @if($equipohistorial->combustible=='1/2') {{'selected'}} @endif value="1/2">1/2</option>
                    <option @if($equipohistorial->combustible=='7/8') {{'selected'}} @endif value="7/8">7/8</option>
                    <option @if($equipohistorial->combustible=='LLENO') {{'selected'}} @endif value="LLENO">LLENO</option>
                </select>
                </div>
                <label>Marque el equipo que posee el vehiculo</label>
                <div class="form-group">
                <div class="form-check form-check-inline">
                    <input disabled @if($equipohistorial->extinguidor==1) {{'checked'}} @endif class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="extinguidor">
                    <label class="form-check-label" for="inlineCheckbox1">Extinguidor</label>
                </div>
                <div class="form-check form-check-inline">
                    <input disabled @if($equipohistorial->botiquin==1) {{'checked'}} @endif class="form-check-input" type="checkbox" id="inlineCheckbox2" value="1" name="botiquin">
                    <label class="form-check-label" for="inlineCheckbox2">Botiquin</label>
                </div>
                <div class="form-check form-check-inline">
                    <input disabled @if($equipohistorial->equiposeguridad==1) {{'checked'}} @endif class="form-check-input" type="checkbox" id="inlineCheckbox3" value="1" name="equiposeguridad">
                    <label class="form-check-label" for="inlineCheckbox3">Triangulo</label>
                </div>
                </div>
                <div class="form-group">
                <label>Observaciones</label>
                <textarea disabled class="form-control" name="observaciones">{{$equipohistorial->observaciones}}</textarea>
                </div>
            </div>
        </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                </div>
                <div class="card-body">
                    <img src="{{$foto}}" class="img-thumbnail col-12 col-xl-4 offset-xl-4">
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