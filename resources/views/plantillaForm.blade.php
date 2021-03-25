<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Alexander Miranda">
  <meta name="apple-mobile-web-app-capable" content="yes">
  @yield('titulo')
  <title>Formularios - Advanced Energy</title>
  <link rel="icon" type="image/png" href="{{asset('img/isotipo.png')}}">
  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/styles.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/mystyleForm.css')}}"/>
  @yield('head')
</head>
<body>
    <div class="container">
        @yield('pagina')
        <div class="row">
            <div class="col-8 offset-2 col-sm-6 offset-sm-3 col-xl-4 offset-xl-4">
                <img width="100%" src="{{asset('img/logoblancob2.png')}}">
            </div>
        </div>
        <div class="row">
            <div class="col-12 pt-3">
                <h4 class="text-center text-primary font-gotham-medium">AT A HIGHER LEVEL</h4>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    @yield('script')
    @yield('script2')
</body>
</html>