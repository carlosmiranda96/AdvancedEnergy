@extends('plantillaForm')
@section('titulo')
<title>Solicitud de empleo - Advanced Energy</title>
@stop
@section('pagina')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" id="formulario">
                <div class="col-10  col-lg-4">
                    <img width="100%" src="{{asset('img/logoverde2.png')}}">
                </div>
                @if (session('mensaje'))
                <div class="col-12">
                    <h1 class="h3 mb-5 mt-5 font-gotham-medium text-secondary">Datos guardados correctamente!!</h1>
                    <a href="https://www.ae-energiasolar.com/empleos">
                        <button class="btn btn-primary">Ver más ofertas de empleo</button>
                    </a>
                    <hr>
                </div>
                @else
                <div class="col-12">
                    <h1 class="h3 mb-3 font-gotham-medium text-secondary">Formulario de Solicitud de Empleo</h1>
                    <hr>
                </div>
                <div class="col-12 pt-3">
                    <form id="frm" class="row"  method="POST" action="{{route('form.solicitudempleo.guardar')}}">
                        @csrf
                        <div class="form-group col-12">
                            <label>Su nombre (requerido) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input" value="{{old('nombre')}}" name="nombre" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Su apellido (requerido) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input" value="{{old('apellido')}}" name="apellido" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Número de dui (requerido) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input" value="{{old('dui')}}" name="dui" required pattern="[0-9]{8}-[0-9]{1}" title="Ejemplo:12345678-9"/>
                        </div>
                        <div class="form-group col-12">
                            <label>Fecha de nacimiento (requerido) <span class="text-danger">*</span></label>
                            <input type="date" class="form-control input" value="{{old('fechanacimiento')}}" name="fechanacimiento" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Dirección Actual (requerido) <span class="text-danger">*</span></label>
                            <textarea class="form-control input" name="direccionactual" required>{{old('direccionactual')}}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <label>Teléfono fijo (requerido) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control input" value="{{old('telefono')}}" name="telefono" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Teléfono Celular (requerido) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control input" value="{{old('celular')}}" name="celular" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Su correo electrónico (requerido) <span class="text-danger">*</span></label>
                            <input type="email" class="form-control input" value="{{old('email')}}" name="email" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Aspiración Salarial (requerido) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control input" value="{{old('aspiracionsalarial')}}" name="aspiracionsalarial" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Nivel de estudios (requerido) <span class="text-danger">*</span></label>
                            <select class="form-control input" name="educacion" required>
                                <option value="">Seleccione</option>
                                <option value="Educación básica">Educación básica</option>
                                <option value="Educación Media">Educación Media</option>
                                <option value="Educación Superior">Educación Superior</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label>Área donde desea aplicar (requerido) <span class="text-danger">*</span></label>
                            <select class="form-control input" name="puesto" required>
                                <option value="">Seleccione</option>
                                <option value="Seguridad Industrial y salud ocupacional" @if($id=="Seguridad Industrial y salud ocupacional") {{'selected'}} @endif>Seguridad Industrial y salud ocupacional</option>
                                <option value="Operador de maquinaria" @if($id=="Operador de maquinaria") {{'selected'}} @endif>Operador de maquinaria</option>
                                <option value="Ingeniero Electricista" @if($id=="Ingeniero Electricista") {{'selected'}} @endif>Ingeniero Electricista</option>
                                <option value="Ingeniero Electricista en subestaciones" @if($id=="Ingeniero Electricista en subestaciones") {{'selected'}} @endif>Ingeniero Electricista en subestaciones</option>
                                <option value="Técnico Electricista" @if($id=="Técnico Electricista") {{'selected'}} @endif>Técnico Electricista</option>
                                <option value="Técnico Soldador" @if($id=="Técnico Soldador") {{'selected'}} @endif>Técnico Soldador</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-5 mb-3">Experiencia Laboral (Coloque el trabajo más actual)</h6>
                            <hr>
                        </div>
                        <div class="form-group col-12">
                            <label>Empresa</label>
                            <input type="text" class="form-control input" value="{{old('Eempresa')}}" id="Eempresa" name="Eempresa"/>
                        </div>
                        <div class="form-group col-12">
                            <label id="labelcargo">Cargo</label>
                            <input type="text" class="form-control input" value="{{old('Ecargo')}}" id="Ecargo" name="Ecargo"/>
                        </div>
                        <div class="form-group col-12">
                            <label id="labelfecha">Fecha de inicio</label>
                            <input type="date" class="form-control input" value="{{old('Efechainicio')}}" id="Efechainicio" name="Efechainicio"/>
                        </div>
                        <div class="form-group col-12">
                            <label id="labelsalario">Salario</label>
                            <input type="number" class="form-control input" value="{{old('Esalario')}}" id="Esalario" name="Esalario"/>
                        </div>
                        <div class="form-group col-12">
                            <label id="labelresponsabilidades">Responsabilidades</label>
                            <textarea class="form-control input" id="Eresponsabilidades" name="Eresponsabilidades">{{old('Eresponsabilidades')}}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <label id="labeltrabajoactual">Trabaja actualmente en esta empresa</label>
                            <select class="form-control input" id="Etrabajoactual" name="Etrabajoactual">
                                <option value="">Seleccione</option>
                                <option value="SI" @if(old('trabajoactual')=="SI") {{'selected'}} @endif>SI</option>
                                <option value="NO" @if(old('trabajoactual')=="NO") {{'selected'}} @endif>NO</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary">Enviar Solicitud</button>
                        <div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@stop

@section('script')
    <script>
        $("#Eempresa").keyup(function(){
            var cantidad = $("#Eempresa").val().length;
            if(cantidad>0){
                $("#labelcargo").html('Cargo (requerido) <span class="text-danger">*</span>');
                $("#Ecargo").prop("required",true);
                $("#labelfecha").html('Fecha de inicio (requerido) <span class="text-danger">*</span>');
                $("#Efechainicio").prop("required",true);
                $("#labelsalario").html('Salario (requerido) <span class="text-danger">*</span>');
                $("#Esalario").prop("required",true);
                $("#labelresponsabilidades").html('Responsabilidades (requerido) <span class="text-danger">*</span>');
                $("#Eresponsabilidades").prop("required",true);
                $("#labeltrabajoactual").html('Trabaja actualmente en esta empresa (requerido) <span class="text-danger">*</span>');
                $("#Etrabajoactual").prop("required",true);
            }else{
                $("#labelcargo").html('Cargo');
                $("#Ecargo").prop("required",false);
                $("#labelfecha").html('Fecha de inicio');
                $("#Efechainicio").prop("required",false);
                $("#labelsalario").html('Salario');
                $("#Esalario").prop("required",false);
                $("#labelresponsabilidades").html('Responsabilidades');
                $("#Eresponsabilidades").prop("required",false);
                $("#labeltrabajoactual").html('Trabaja actualmente en esta empresa');
                $("#Etrabajoactual").prop("required",false);
            }
        });
    </script>
@stop