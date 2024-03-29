@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Empleados</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('empleados.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspNuevo empleado</h6>
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
            <form id="frmempleado" method="POST" action="{{route('empleados.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-2">
                        <div class="row">
                            <div class="col-6 offset-3 col-lg-3 offset-lg-4 col-xl-12 offset-xl-0">
                            <img id="fotoperfil" width="100%" src="{{asset(Storage::url('app/fotoperfil/perfilDefault.jpg'))}}" class="img-thumbnail">
                            <div class="custom-file mb-3" style="cursor:pointer;">
                                <input type="file" id="foto" name="foto" value="{{old('foto')}}" class="custom-file-input" id="validatedCustomFile" accept="image/*">
                                <div class="col-12 btn btn-sm btn-secondary" style="position:absolute;left:0;"><i class="fas fa-upload"></i> Cambiar foto</div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <h5 class="font-weight-bold text-primary">Datos personales</h5>
                                <hr>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Codigo de carnet</label>
                                    <input disabled type="text" name="codigo" value="{{old('codigo')}}" class="form-control form-control-sm" autofocus autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Nombre 1 <span class="text-danger">*</span></label>
                                    <input type="text" id="nombre1" name="nombre1" value="{{old('nombre1')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Nombre 2</label>
                                    <input type="text" id="nombre2" name="nombre2" value="{{old('nombre2')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Apellido 1 <span class="text-danger">*</span></label>
                                    <input type="text" id="apellido1" name="apellido1" value="{{old('apellido1')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Apellido 2</label>
                                    <input type="text" id="apellido2" name="apellido2" value="{{old('apellido2')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Apellido de casada</label>
                                    <input type="text" id="apellido3" name="apellido3" value="{{old('apellido3')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label>Nombre completo <span class="text-danger">*</span></label>
                                    <input type="text" id="nombrecompleto" name="nombrecompleto" value="{{old('nombrecompleto')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Estado civil <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="idestadocivil">
                                        <option value="0">Seleccione</option>
                                        @foreach($estadocivil as $item)
                                        <option @if(old('idestadocivil')==$item->id) {{'selected'}} @endif value="{{$item->id}}">{{$item->estadocivil}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Genero <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="idgenero">
                                        <option value="0">Seleccione</option>
                                        @foreach($genero as $item)
                                        <option @if(old('idgenero')==$item->id) {{'selected'}} @endif value="{{$item->id}}">{{$item->genero}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Fecha nacimiento</label>
                                    <input type="date" name="fechanacimiento" value="{{old('fechanacimiento')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <h5 class="font-weight-bold text-primary">Datos de contacto</h5>
                                <hr>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" name="telefono" value="{{old('telefono')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" name="celular" value="{{old('celular')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input type="text" name="correo" value="{{old('correo')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label>Pais <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" id="pais">
                                        <option value="0">Seleccione</option>
                                        @foreach($pais as $item)
                                        <option value="{{$item->id}}">{{$item->pais}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label>Departamento <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" id="departamento">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label>Municipio <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="idmunicipio" id="iddepartamento">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <textarea class="form-control form-control-sm" name="direccion"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-lg-6">
                                <h5 class="font-weight-bold text-primary">Fecha de ingreso</h5>
                                <hr>
                                <div class="form-group">
                                    <label>Fecha <span class="text-danger">*</span></label>
                                    <input type="date" name="fechaingreso" value="{{old('fechaingreso')}}" class="form-control form-control-sm" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h5 class="font-weight-bold text-primary">Estado</h5>
                                <hr>
                                <div class="form-group">
                                    <label>Seleccione <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="estado">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <a href="{{route('empleados.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
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
@section('script')
    <script>
        function filePreview(input) {
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#frmempleado + img').remove();
                    $("#fotoperfil").attr("src",e.target.result);
                }
            }
        }
        $("#foto").change(function () {
            filePreview(this);
        });
        $("#pais").on("change",function(){
            $.ajax({
                type:"GET",
                dataType:"json",
                data:"idpais="+$(this).val(),
                url:"{{route('pais.departamento')}}",
                success:function(r){
                    $("#departamento").empty();
                    $("#departamento").append('<option value="0">Seleccione</option>');
                    $.each(r,function(value,key){  
                        $("#departamento").append('<option value="'+key.id+'">'+key.codigo+" "+key.departamento+'</option>');
                    });
                },
                error:function(){
                    alert("Error");
                },
                beforeSend:function(){
                    $("#departamento").empty();
                    $("#departamento").append('<option value="0">Cargando...</option>');
                    $("#iddepartamento").empty();
                    $("#iddepartamento").append('<option value="0">Seleccione</option>');
                }
            })
        });
        $("#departamento").on("change",function(){
            $.ajax({
                type:"GET",
                dataType:"json",
                data:"iddepartamento="+$(this).val(),
                url:"{{route('svmunicipio.departamento')}}",
                success:function(r){
                    $("#iddepartamento").empty();
                    $("#iddepartamento").append('<option value="0">Seleccione</option>');
                    $.each(r,function(value,key){  
                        $("#iddepartamento").append('<option value="'+key.id+'">'+key.codigo+" "+key.municipio+'</option>');
                    });
                },
                beforeSend:function(){
                    $("#iddepartamento").empty();
                    $("#iddepartamento").append('<option value="0">Cargando...</option>');
                }
            })
        });
        $("#nombre1").on("blur",function(){
            cargarNombre();
        });
        $("#nombre2").on("blur",function(){
            cargarNombre();
        });
        $("#apellido1").on("blur",function(){
            cargarNombre();
        });
        $("#apellido2").on("blur",function(){
            cargarNombre();
        });
        $("#apellido3").on("blur",function(){
            cargarNombre();
        });
        function cargarNombre()
        {
            nombre1 = $("#nombre1").val();
            nombre2 = $("#nombre2").val();
            apellido1 = $("#apellido1").val();
            apellido2 = $("#apellido2").val();
            apellido3 = $("#apellido3").val();
            if(nombre2){
                nombre2 = " "+nombre2;
            }
            if(apellido1){
                apellido1 = " "+apellido1;
            }
            if(apellido2){
                apellido2 = " "+apellido2;
            }
            if(apellido3){
                apellido3 = " de "+apellido3;
            }
            nombrecompleto = nombre1+nombre2+apellido1+apellido2+apellido3;
            $("#nombrecompleto").val(""+nombrecompleto);
        }
    </script>
@stop