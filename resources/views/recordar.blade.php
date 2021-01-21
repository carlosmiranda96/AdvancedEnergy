@extends('plantillaLogin')
@section('pagina')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 bg-secondary">
          <div class="card-body p-0 text-white">
            <!-- Nested Row within Card Body -->
            <div class="row">
            <div class="col-lg-6 d-none d-lg-block align-middle">
                <img class="col-12" src="{{asset('')}}img/isotipo.png">
              </div>
              <div class="col-lg-6">
                <div class="p-4">
                  <img class="col-12" src="{{asset('')}}img/logo.png"/>
                  <div class="text-center">
                    <h5 class="mb-3">¿Olvidaste la contraseña?</h5>
                  </div>
                  <form id="frmrestablecer" action="#" type="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user input" id="email" name="email" required placeholder="Ingresa tu correo">
                    </div>
                    <input class="btn btn-primary col-12" type="submit" value="Restablecer contraseña">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="text-white" href="{{ route('login')}}">¿Ya tienes una cuenta? Inicia sesión!</a>
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
  $(document).ready(function(){
    $("#frmrestablecer").bind("submit",function(){
      var datos = $("#frmrestablecer").serialize();
      bootbox.alert({ 
        title:'Notificación',
        message: "Mensaje",
        callback: function(result)
        {
          if(result==true){
            window.location.href = "{{route('cerrarsesion')}}";
          }
        }
      });
      /*$.ajax({
        type:"post",
        url:"{{route('api.form.covid.enviar')}}",
        data:datos+'&_token={{csrf_token()}}',
        success:function(r)
        {

        }
      });*/
      return false;
    });
  });
</script>
@stop