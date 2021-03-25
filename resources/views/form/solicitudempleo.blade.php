@extends('plantillaForm')
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
                            <label>N° de dui (requerido) <span class="text-danger">*</span></label>
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
                            <label>Telefono fijo (requerido) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control input" value="{{old('telefono')}}" name="telefono" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Telefono Celular (requerido) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control input" value="{{old('celular')}}" name="celular" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Su correo electronico (requerido) <span class="text-danger">*</span></label>
                            <input type="email" class="form-control input" value="{{old('email')}}" name="email" required/>
                        </div>
                        <div class="form-group col-12">
                            <label>Aspiración Salarial</label>
                            <input type="number" class="form-control input" value="{{old('aspiracionsalarial')}}" name="aspiracionsalarial"/>
                        </div>
                        <div class="form-group col-12">
                            <label>Educación</label>
                            <select class="form-control input" name="educacion">
                                <option value="0">Seleccione</option>
                                <option value="Estudios secundarios completos">Estudios secundarios completos</option>
                                <option value="Estudio Técnico">Estudio Técnico</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label>Area donde desea aplicar</label>
                            <select class="form-control input" name="puesto">
                                <option value="0">Seleccione</option>
                                <option value="Técnico Electricista">Técnico Electricista</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-5 mb-3">Experiencia Laboral (Coloque el trabajo más actual)</h6>
                            <hr>
                        </div>
                        <div class="form-group col-12">
                            <label>Empresa</label>
                            <input type="text" class="form-control input" value="{{old('Eempresa')}}" name="Eempresa"/>
                        </div>
                        <div class="form-group col-12">
                            <label>Cargo</label>
                            <input type="text" class="form-control input" value="{{old('Ecargo')}}" name="Ecargo"/>
                        </div>
                        <div class="form-group col-12">
                            <label>Fecha de inicio</label>
                            <input type="date" class="form-control input" value="{{old('Efechainicio')}}" name="Efechainicio"/>
                        </div>
                        <div class="form-group col-12">
                            <label>Salario</label>
                            <input type="number" class="form-control input" value="{{old('Esalario')}}" name="Esalario"/>
                        </div>
                        <div class="form-group col-12">
                            <label>Responsabilidades</label>
                            <textarea class="form-control input" name="Eresponsabilidades">{{old('Eresponsabilidades')}}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <label>Trabaja actualmente en esta empresa</label>
                            <select class="form-control input" name="Etrabajoactual">
                                <option>Seleccione</option>
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