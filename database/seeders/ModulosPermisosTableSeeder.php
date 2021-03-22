<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formucs')->insert([
            ["id"=>'1',"sintoma"=>'Tos',"puntos"=>1],
            ["id"=>'2',"sintoma"=>'Escalofrios',"puntos"=>1],
            ["id"=>'3',"sintoma"=>'Diarrea',"puntos"=>1],
            ["id"=>'4',"sintoma"=>'Dolor de garganta',"puntos"=>1],
            ["id"=>'5',"sintoma"=>'Dolor de cuerpo / Malestar general',"puntos"=>1],
            ["id"=>'6',"sintoma"=>'Dolor de cabeza',"puntos"=>1],
            ["id"=>'7',"sintoma"=>'Fiebre mayor a 37.8 grados C',"puntos"=>1],
            ["id"=>'8',"sintoma"=>'Perdida de Olfato y/o Gusto',"puntos"=>1],
            ["id"=>'9',"sintoma"=>'Dolor en la nariz al respirar',"puntos"=>1],
            ["id"=>'10',"sintoma"=>'Dificultad para respirar (Como si no entrara aire al pecho)',"puntos"=>1],
            ["id"=>'11',"sintoma"=>'Siente fatiga con solo caminar o hablar',"puntos"=>1],
            ["id"=>'12',"sintoma"=>'Has viajado o estado en un área o zona afectada por COVID 19 en los últimos 8 dias',"puntos"=>1],
            ["id"=>'13',"sintoma"=>'Has estado en contacto directo o cuidado a algún paciente que ha dado positivo COVID 19 en los ultimos 8 dias',"puntos"=>1]
         ]);
        /*
        DB::table('modulos')->insert([
            ["id" => '1',"modulo" => 'General',"ruta" => 'general',"icono"=>'<i class="fas fa-qrcode fa-3x"></i>'],
            ["id" => '2',"modulo" => 'RRHH',"ruta" => 'rrhh',"icono"=>'<i class="fas fa-users fa-3x"></i>'],
            ["id" => '3',"modulo" => 'Ingenieria',"ruta" => 'ingenieria.index',"icono"=>'<i class="fab fa-wpforms fa-3x"></i>'],
            ["id" => '4',"modulo" => 'Reportes',"ruta" => 'reportes',"icono"=>'<i class="fas fa-file-signature fa-3x"></i>']
        ]);
        DB::table('permisos')->insert([
            ["id" => '1',"nombre" => 'Mostrar',"ruta" => '0','idmodulo'=>'1'],
            ["id" => '2',"nombre" => 'Mostrar',"ruta" => '0','idmodulo'=>'2'],
            ["id" => '3',"nombre" => 'Mostrar',"ruta" => '0','idmodulo'=>'3'],
            ["id" => '4',"nombre" => 'Mostrar',"ruta" => '0','idmodulo'=>'4'],
            ["id" => '5',"nombre" => 'Reporte de asistencia',"ruta" => 'reportes.asistencia','idmodulo'=>'4'],
            ["id" => '6',"nombre" => 'Reporte de control de vehiculos',"ruta" => 'reportes.vehiculos','idmodulo'=>'4'],
            ["id" => '7',"nombre" => 'Reporte de empleados',"ruta" => 'reportes.empleados','idmodulo'=>'4']
        ]);*/
    }
}
