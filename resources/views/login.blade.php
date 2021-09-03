@extends('plantillaLogin')
@section('pagina')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5 bg-gradient-primary bg-secondary">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block align-middle">
                <img class="col-12" src="{{asset('')}}img/isotipo.png">
              </div>
              <div class="col-lg-6">
                <div class="p-4">  
                  <div class="text-center">
                    <img class="col-12" src="{{asset('')}}img/logoblanco2.png"/>
                  </div>
                  <div class="text-center text-white">
                    <h5 class="mb-3">¡Bienvenido! Ingresa tus credenciales</h5>
                  </div>
                  <form class="user" action="{{route('iniciarsesion')}}" method="post">
                    @csrf
                    @if(session('mensaje'))
                    <div class="alert alert-danger" role="alert">
                      {{session('mensaje')}}
                    </div>
                    @endif
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user input" name="email" value="{{$email}}" @if(!session('email')) {{'autofocus'}} @endif placeholder="Correo o Usuario" required >
                    </div>
                    <div class="form-group col-12 p-0">
                      <input type="password" class="form-control form-control-user input" id="password" name="password" value="{{$password}}" autofocus placeholder="Clave" required>
                      <button id="show_password" class="btn" type="button" onmousedown="mostrarPassword()" onmouseup="mostrarPassword()">  <span id="btnpassword" class="fa fa-eye-slash icon"></span> </button>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input @if ($email) {{'checked'}}  @endif type="checkbox" class="custom-control-input" id="recordar" name="recordar">
                        <label class="custom-control-label text-white" for="recordar">Recordar usuario</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Iniciar sesión
                    </button>
                    <!--button class="btn btn-primary btn-user btn-block" id="btniniciar">Iniciar sesión</button-->
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="text-white" href="{{ route('recordar')}}">¿Olvido la contraseña?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@section('script')
<script>
    function mostrarPassword(){
      var input = document.getElementById("password");
      if(input.type == "password"){
        input.type = "text";
        $('#btnpassword').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
      }else{
        input.type = "password";
        $('#btnpassword').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
      }
    }
</script>
@stop