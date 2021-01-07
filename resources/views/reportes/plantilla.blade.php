<?php date_default_timezone_set('America/El_Salvador');?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte</title>
        <style>
             @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                color: black;
                text-align: center;
                line-height: 1.5cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 1cm; 
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                color: black;
                text-align: left;
                line-height: 1.5cm;
            }
            main{
                margin-left:1cm;
                margin-right: 1cm;
                margin-top: 2.5cm;
                margin-bottom: 2.5cm;
            }
            hr{
                page-break-after: always;
                border: none;
                margin: 0;
                padding: 0;
            }
        </style>
        <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    </head>
    <body>
        <header>
            <img src="{{asset('img/logoverde2.png')}}" class="pt-4" height="100%"/>
            <p style="position:absolute;top:0cm;right:1cm;font-size:11px;">{{date('h:i a d/m/Y')}}</p>
        </header>

        <footer>
            <p style="color: #2E9A73;">AT A HIGHER LEVEL</p>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            @yield('reporte')
        </main>
    </body>
</html>