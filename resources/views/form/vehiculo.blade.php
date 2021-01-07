@extends('plantillaQR')
@section('pagina')
<div class="row">
    <div class="col-12 pt-4 pb-2">
        <h1 class="h3 mb-0 font-gotham-medium color-secondary text-center">Control de vehiculos</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 text-white font-alright-regular pb-3">
        <p class="font-weight-bold text-primary">Condiciones Generales</p>
        <li class="">No Fumar</li>
        <li>No pasar los limites de velocidad establecidos y/o 90 km/h</li>
        <li>No llevar a personas ajenas a la empresa </li>
        <li>Verificar equipo de seguridad, triangulo y extinguido entre otros.</li>
        <li>Verificar que cuente con botiquín</li>
        <li>Verificar que cuente con atomizador</li>
        <li>Verificar que cuente con alcohol gel</li>
        <li>DESINFECTAR después de cada turno</li>
        <li>Contar con tarjeta de circulación y carnet o sticker de seguro</li>
        <li>Usar mascarilla dentro del vehículo</li>
        <li>Prohibido consumir bebidas alcohólicas</li>
        <li>NO dejar basura</li>
        <hr style="background-color:white">
    </div>
</div>
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
    </div>
</div>
<div class="row">
    <div class="col-12 text-white">
        <form class="row" id="frmvehiculo" method="POST" action="{{route('api.form.vehiculo.update',$equipohistorial->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-12 col-lg-4">
            <label>Especifique el uso <span class="text-danger">*</span></label>
            <select class="form-control input" name="uso" autofocus required {{$disabled}}>
                <option @if(old('uso')=='0') {{'selected'}} @endif value="0">Seleccione</option>
                <option @if(old('uso')=='Oficina') {{'selected'}} @endif value="Oficina">Oficina</option>
                <option @if(old('uso')=='Proyecto') {{'selected'}} @endif value="Proyecto">Proyecto</option>
                <option @if(old('uso')=='Operación y mantenimiento') {{'selected'}} @endif value="Operación y mantenimiento">Operación y mantenimiento</option>
                <option @if(old('uso')=='Personal') {{'selected'}} @endif value="Personal">Personal</option>
                <option @if(old('uso')=='Devolución') {{'selected'}} @endif value="Devolución">Devolución</option>
            </select>
            </div>
            <div class="form-group col-12 col-lg-4">
            <label>Kilometraje <span class="text-danger">*</span></label>
            <input type="number" class="form-control input" value="{{old('kilometraje')}}" {{$disabled}} name="kilometraje"/>
            </div>
            <div class="form-group col-12 col-lg-4">
            <label>Combustible <span class="text-danger">*</span></label>
            <select class="form-control input" name="combustible" {{$disabled}}>
                <option @if(old('combustible')=='0') {{'selected'}} @endif value="0">Seleccione</option>
                <option @if(old('combustible')=='1/4') {{'selected'}} @endif value="1/4">1/4</option>
                <option @if(old('combustible')=='1/3') {{'selected'}} @endif value="1/3">1/3</option>
                <option @if(old('combustible')=='1/2') {{'selected'}} @endif value="1/2">1/2</option>
                <option @if(old('combustible')=='7/8') {{'selected'}} @endif value="7/8">7/8</option>
                <option @if(old('combustible')=='LLENO') {{'selected'}} @endif value="LLENO">LLENO</option>
            </select>
            </div>
            <div class="col-12">
                <label>Marque el equipo que posee el vehiculo</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input input" type="checkbox" id="inlineCheckbox1" value="1" name="extinguidor" {{$disabled}}>
                        <label class="form-check-label" for="inlineCheckbox1">Extinguidor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input input" type="checkbox" id="inlineCheckbox2" value="1" name="botiquin" {{$disabled}}>
                        <label class="form-check-label" for="inlineCheckbox2">Botiquin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input input" type="checkbox" id="inlineCheckbox3" value="1" name="equiposeguridad" {{$disabled}}>
                        <label class="form-check-label" for="inlineCheckbox3">Triangulo</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-12">
                <label>Cualquier duda o sugerencia escribirla a continuación</label>
                <textarea class="form-control input" name="observaciones" {{$disabled}}></textarea>
            </div>
            <div class="form-group col-12">
                <button class="btn btn-primary col-12" {{$disabled}}><i class="fas fa-check"></i> Finalizar</button>
            </div>
        </form>
    </div>
</div>
@stop