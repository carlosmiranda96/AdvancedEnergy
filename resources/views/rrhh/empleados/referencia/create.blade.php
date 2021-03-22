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
            <form id="frmempleado" method="POST" action="{{route('empleadoreferencia.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-2">
                        <div class="row mb-3">
                            <div class="col-6 offset-3 col-lg-3 offset-lg-4 col-xl-12 offset-xl-0">
                            <img id="fotoperfil" width="100%" src="{{asset(Storage::url('app/'.$empleados->foto))}}" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10">
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
                                <h5 class="font-weight-bold text-primary">Nueva referencia</h5>
                                <hr>
                            </div>
                            <input hidden type="text" class="form-control" name="idempleado" value="{{$empleados->id}}" required/>
                            <div class="col-sm-6 col-xl-4">
                                <div class="form-group">
                                    <label>Tipo <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tipo" autofocus required>
                                        <option @if(old('tipo')=="Personal") {{'selected'}} @endif value="Personal">Personal</option>
                                        <option @if(old('tipo')=="Familiar") {{'selected'}} @endif value="Familiar">Familiar</option>
                                        <option @if(old('tipo')=="Trabajo") {{'selected'}} @endif value="Trabajo">Trabajo</option>
                                        <option @if(old('tipo')=="Trabajo") {{'selected'}} @endif value="Trabajo">Otra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-8">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input value="{{old('nombre')}}" type="text" class="form-control" name="nombre"/>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="form-group">
                                    <label>Contacto</label>
                                    <input value="{{old('contacto')}}" type="text" class="form-control" name="contacto"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <a href="{{route('empleadoreferencia.show',$empleados->id)}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop