@extends('mail.plantilla')
@section('pagina')
<div class="body">
    <h1>¡Nueva solicitud de empleo!</h1>
    <hr>
    <br></br>
    <table>
        <tr>
            <th colspan="2">Datos personales</th>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{$solicitud->nombre}}</td>
        </tr>
        <tr>
            <th>Apellido</th>
            <td>{{$solicitud->apellido}}</td>
        </tr>
        <tr>
            <th>Dui</th>
            <td>{{$solicitud->dui}}</td>
        </tr>
        <tr>
            <th>Fecha de nacimiento</th>
            <td>{{$solicitud->fechanacimiento}}</td>
        </tr>
        <tr>
            <th>Dirección Actual</th>
            <td>{{$solicitud->direccionactual}}</td>
        </tr>
        <tr>
            <th>Telefono Fijo</th>
            <td>{{$solicitud->telefono}}</td>
        </tr>
        <tr>
            <th>Telefono Celular</th>
            <td>{{$solicitud->celular}}</td>
        </tr>
        <tr>
            <th>Correo Electronico</th>
            <td>{{$solicitud->email}}</td>
        </tr>
        <tr>
            <th>Aspiración Salarial</th>
            <td>{{$solicitud->aspiracionsalarial}}</td>
        </tr>
        <tr>
            <th>Nivel de estudios</th>
            <td>{{$solicitud->educacion}}</td>
        </tr>
        <tr>
            <th>Area donde desea aplicar</th>
            <td>{{$solicitud->puesto}}</td>
        </tr>
        <tr>
            <th colspan="2">Experiencia laboral</th>
        </tr>
        <tr>
            <th>Empresa</th>
            <td>{{$solicitud->Eempresa}}</td>
        </tr>
        <tr>
            <th>Cargo</th>
            <td>{{$solicitud->Ecargo}}</td>
        </tr>
        <tr>
            <th>Fecha de inicio</th>
            <td>{{$solicitud->Efechainicio}}</td>
        </tr>
        <tr>
            <th>Salario</th>
            <td>{{$solicitud->Esalario}}</td>
        </tr>
        <tr>
            <th>Responsabilidades</th>
            <td>{{$solicitud->Eresponsabilidades}}</td>
        </tr>
        <tr>
            <th>Trabaja actualmente en esta empresa</th>
            <td>{{$solicitud->Etrabajoactual}}</td>
        </tr>
    </table>
    <br></br>
</div>
@stop
