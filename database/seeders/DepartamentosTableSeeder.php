<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipodocumentos')->insert([
            ["tipodocumento" => 'DUI']
        ]);
        DB::table('estadocivils')->insert([
            ["estadocivil" => 'Soltero/a']
        ]);
        DB::table('generos')->insert([
            ["genero" => 'Masculino'],
            ["genero" => 'Femenino']
        ]);
        DB::table('pais')->insert([
            ["id" => '1',"pais" => 'El Salvador']
        ]);
        DB::table('svdepartamentos')->insert([
            ["id" => '1',"codigo" => '01','departamento'=>'Ahuachapan','idpais'=>1],
            ["id" => '2',"codigo" => '02','departamento'=>'Santa Ana','idpais'=>1],
            ["id" => '3',"codigo" => '03','departamento'=>'Son Sonate','idpais'=>1],
            ["id" => '4',"codigo" => '04','departamento'=>'Chalatenango','idpais'=>1],
            ["id" => '5',"codigo" => '05','departamento'=>'La Libertad','idpais'=>1],
            ["id" => '6',"codigo" => '06','departamento'=>'San Salvador','idpais'=>1],
            ["id" => '7',"codigo" => '07','departamento'=>'Cuscatlan','idpais'=>1],
            ["id" => '8',"codigo" => '08','departamento'=>'La Paz','idpais'=>1],
            ["id" => '9',"codigo" => '09','departamento'=>'Cabañas','idpais'=>1],
            ["id" => '10',"codigo" => '10','departamento'=>'San Vicente','idpais'=>1],
            ["id" => '11',"codigo" => '11','departamento'=>'Usulutan','idpais'=>1],
            ["id" => '12',"codigo" => '12','departamento'=>'San Miguel','idpais'=>1],
            ["id" => '13',"codigo" => '13','departamento'=>'Morazán','idpais'=>1],
            ["id" => '14',"codigo" => '14','departamento'=>'La Unión','idpais'=>1]
        ]);
        //01 ahuachapan
        DB::table('svmunicipios')->insert([
            ["codigo" => '0101','municipio'=>'Ahuachapan','iddepartamento'=>1],
            ["codigo" => '0102','municipio'=>'Apaneca','iddepartamento'=>1],
            ["codigo" => '0103','municipio'=>'Atiquizaya','iddepartamento'=>1],
            ["codigo" => '0104','municipio'=>'Concepción de Ataco','iddepartamento'=>1],
            ["codigo" => '0105','municipio'=>'El Refugio','iddepartamento'=>1],
            ["codigo" => '0106','municipio'=>'Guaymango','iddepartamento'=>1],
            ["codigo" => '0107','municipio'=>'Jujutla','iddepartamento'=>1],
            ["codigo" => '0108','municipio'=>'San Francisco Menéndez','iddepartamento'=>1],
            ["codigo" => '0109','municipio'=>'San Lorenzo','iddepartamento'=>1],
            ["codigo" => '0110','municipio'=>'San Pedro Puxtla','iddepartamento'=>1],
            ["codigo" => '0111','municipio'=>'Tacuba','iddepartamento'=>1],
            ["codigo" => '0112','municipio'=>'Turín','iddepartamento'=>1]
        ]);
        //02 santa ana
        DB::table('svmunicipios')->insert([
            ["codigo" => '0201','municipio'=>'Candelaria de la Frontera','iddepartamento'=>2],
            ["codigo" => '0202','municipio'=>'Chalchuapa','iddepartamento'=>2],
            ["codigo" => '0203','municipio'=>'Coatepeque','iddepartamento'=>2],
            ["codigo" => '0204','municipio'=>'El Congo','iddepartamento'=>2],
            ["codigo" => '0205','municipio'=>'El Porvenir','iddepartamento'=>2],
            ["codigo" => '0206','municipio'=>'Masahuat','iddepartamento'=>2],
            ["codigo" => '0207','municipio'=>'Metapán','iddepartamento'=>2],
            ["codigo" => '0208','municipio'=>'San Antonio Pajonal','iddepartamento'=>2],
            ["codigo" => '0209','municipio'=>'San Sebastián Salitrillo','iddepartamento'=>2],
            ["codigo" => '0210','municipio'=>'Santa Ana','iddepartamento'=>2],
            ["codigo" => '0211','municipio'=>'Santa Rosa Guachipilín','iddepartamento'=>2],
            ["codigo" => '0212','municipio'=>'Santiago de la Frontera','iddepartamento'=>2],
            ["codigo" => '0213','municipio'=>'Texistepeque','iddepartamento'=>2]
        ]);
        //03 sonsonate
        DB::table('svmunicipios')->insert([
            ["codigo" => '0301','municipio'=>'Acajutla','iddepartamento'=>3],
            ["codigo" => '0302','municipio'=>'Armenia','iddepartamento'=>3],
            ["codigo" => '0303','municipio'=>'Caluco','iddepartamento'=>3],
            ["codigo" => '0304','municipio'=>'Cuisnahuat','iddepartamento'=>3],
            ["codigo" => '0305','municipio'=>'Izalco','iddepartamento'=>3],
            ["codigo" => '0306','municipio'=>'Juayúa','iddepartamento'=>3],
            ["codigo" => '0307','municipio'=>'Nahuizalco','iddepartamento'=>3],
            ["codigo" => '0308','municipio'=>'Nahulingo','iddepartamento'=>3],
            ["codigo" => '0309','municipio'=>'Salcoatitán','iddepartamento'=>3],
            ["codigo" => '0310','municipio'=>'San Antonio del Monte','iddepartamento'=>3],
            ["codigo" => '0311','municipio'=>'San Julián','iddepartamento'=>3],
            ["codigo" => '0312','municipio'=>'Santa Catarina Masahuat','iddepartamento'=>3],
            ["codigo" => '0313','municipio'=>'Santa Isabel Ishuatán','iddepartamento'=>3],
            ["codigo" => '0314','municipio'=>'Santo Domingo de Guzmán','iddepartamento'=>3],
            ["codigo" => '0315','municipio'=>'Sonsonate','iddepartamento'=>3],
            ["codigo" => '0316','municipio'=>'Sonzacate','iddepartamento'=>3]
        ]);
        //04 chalatenango
        DB::table('svmunicipios')->insert([
            ["codigo" => '0401','municipio'=>'Agua Caliente','iddepartamento'=>4],
            ["codigo" => '0402','municipio'=>'Arcatao','iddepartamento'=>4],
            ["codigo" => '0403','municipio'=>'Azacualpa','iddepartamento'=>4],
            ["codigo" => '0404','municipio'=>'Chalatenango','iddepartamento'=>4],
            ["codigo" => '0405','municipio'=>'Citalá','iddepartamento'=>4],
            ["codigo" => '0406','municipio'=>'Comalapa','iddepartamento'=>4],
            ["codigo" => '0407','municipio'=>'Concepción Quezaltepeque','iddepartamento'=>4],
            ["codigo" => '0408','municipio'=>'Dulce Nombre de María','iddepartamento'=>4],
            ["codigo" => '0409','municipio'=>'El Carrizal','iddepartamento'=>4],
            ["codigo" => '0410','municipio'=>'El Paraíso','iddepartamento'=>4],
            ["codigo" => '0411','municipio'=>'La Laguna','iddepartamento'=>4],
            ["codigo" => '0412','municipio'=>'La Palma','iddepartamento'=>4],
            ["codigo" => '0413','municipio'=>'La Reina','iddepartamento'=>4],
            ["codigo" => '0414','municipio'=>'Las Vueltas','iddepartamento'=>4],
            ["codigo" => '0415','municipio'=>'Nombre de Jesús','iddepartamento'=>4],
            ["codigo" => '0416','municipio'=>'Nueva Concepción','iddepartamento'=>4],
            ["codigo" => '0417','municipio'=>'Nueva Trinidad','iddepartamento'=>4],
            ["codigo" => '0418','municipio'=>'Ojos de Agua','iddepartamento'=>4],
            ["codigo" => '0419','municipio'=>'Potonico','iddepartamento'=>4],
            ["codigo" => '0420','municipio'=>'San Antonio de la Cruz','iddepartamento'=>4],
            ["codigo" => '0421','municipio'=>'San Antonio Los Ranchos','iddepartamento'=>4],
            ["codigo" => '0422','municipio'=>'San Fernando','iddepartamento'=>4],
            ["codigo" => '0423','municipio'=>'San Francisco Lempa','iddepartamento'=>4],
            ["codigo" => '0424','municipio'=>'San Francisco Morazán','iddepartamento'=>4],
            ["codigo" => '0425','municipio'=>'San Ignacio','iddepartamento'=>4],
            ["codigo" => '0426','municipio'=>'San Isidro Labrador','iddepartamento'=>4],
            ["codigo" => '0427','municipio'=>'San José Cancasque / Cancasque','iddepartamento'=>4],
            ["codigo" => '0428','municipio'=>'San José Las Flores / Las Flores','iddepartamento'=>4],
            ["codigo" => '0429','municipio'=>'San Luis del Carmen','iddepartamento'=>4],
            ["codigo" => '0430','municipio'=>'San Miguel de Mercedes','iddepartamento'=>4],
            ["codigo" => '0431','municipio'=>'San Rafael','iddepartamento'=>4],
            ["codigo" => '0432','municipio'=>'Santa Rita','iddepartamento'=>4],
            ["codigo" => '0433','municipio'=>'Tejutla','iddepartamento'=>4],
        ]);
        //05 Libertad
        DB::table('svmunicipios')->insert([
            ["codigo" => '0501','municipio'=>'Antiguo Cuscatlán','iddepartamento'=>5],
            ["codigo" => '0502','municipio'=>'Chiltiupán','iddepartamento'=>5],
            ["codigo" => '0503','municipio'=>'Ciudad Arce','iddepartamento'=>5],
            ["codigo" => '0504','municipio'=>'Colón','iddepartamento'=>5],
            ["codigo" => '0505','municipio'=>'Comasagua','iddepartamento'=>5],
            ["codigo" => '0506','municipio'=>'Huizúcar','iddepartamento'=>5],
            ["codigo" => '0507','municipio'=>'Jayaque','iddepartamento'=>5],
            ["codigo" => '0508','municipio'=>'Jicalapa','iddepartamento'=>5],
            ["codigo" => '0509','municipio'=>'La Libertad','iddepartamento'=>5],
            ["codigo" => '0510','municipio'=>'Nuevo Cuscatlán','iddepartamento'=>5],
            ["codigo" => '0511','municipio'=>'Santa Tecla','iddepartamento'=>5],
            ["codigo" => '0512','municipio'=>'Quezaltepeque','iddepartamento'=>5],
            ["codigo" => '0513','municipio'=>'34f5','iddepartamento'=>5],
            ["codigo" => '0514','municipio'=>'San José Villanueva','iddepartamento'=>5],
            ["codigo" => '0515','municipio'=>'San Juan Opico','iddepartamento'=>5],
            ["codigo" => '0516','municipio'=>'San Matías','iddepartamento'=>5],
            ["codigo" => '0517','municipio'=>'San Pablo Tacachico','iddepartamento'=>5],
            ["codigo" => '0518','municipio'=>'Talnique','iddepartamento'=>5],
            ["codigo" => '0519','municipio'=>'Tamanique','iddepartamento'=>5],
            ["codigo" => '0520','municipio'=>'Teotepeque','iddepartamento'=>5],
            ["codigo" => '0521','municipio'=>'Tepecoyo','iddepartamento'=>5],
            ["codigo" => '0522','municipio'=>'Zaragoza','iddepartamento'=>5]
        ]);
        //06 SS
        DB::table('svmunicipios')->insert([
            ["codigo" => '0601','municipio'=>'Aguilares','iddepartamento'=>6],
            ["codigo" => '0602','municipio'=>'Apopa','iddepartamento'=>6],
            ["codigo" => '0603','municipio'=>'Ayutuxtepeque','iddepartamento'=>6],
            ["codigo" => '0604','municipio'=>'Cuscatancingo','iddepartamento'=>6],
            ["codigo" => '0605','municipio'=>'Cuscatancingo','iddepartamento'=>6],
            ["codigo" => '0606','municipio'=>'El Paisnal','iddepartamento'=>6],
            ["codigo" => '0607','municipio'=>'Guazapa','iddepartamento'=>6],
            ["codigo" => '0608','municipio'=>'Mejicanos','iddepartamento'=>6],
            ["codigo" => '0609','municipio'=>'Nejapa','iddepartamento'=>6],
            ["codigo" => '0610','municipio'=>'Panchimalco','iddepartamento'=>6],
            ["codigo" => '0611','municipio'=>'Rosario de Mora','iddepartamento'=>6],
            ["codigo" => '0612','municipio'=>'San Marcos','iddepartamento'=>6],
            ["codigo" => '0613','municipio'=>'San Martín','iddepartamento'=>6],
            ["codigo" => '0614','municipio'=>'San Salvador','iddepartamento'=>6],
            ["codigo" => '0615','municipio'=>'Santiago Texacuangos','iddepartamento'=>6],
            ["codigo" => '0616','municipio'=>'Santo Tomás','iddepartamento'=>6],
            ["codigo" => '0617','municipio'=>'Soyapango','iddepartamento'=>6],
            ["codigo" => '0618','municipio'=>'Tonacatepeque','iddepartamento'=>6],
            ["codigo" => '0619','municipio'=>'Delgado','iddepartamento'=>6]
        ]);
        /*
        //07 cuscatlan
        DB::table('svmunicipios')->insert([
            ["codigo" => '07','municipio'=>'','iddepartamento'=>7],
        ]);
        //08 Paz
        DB::table('svmunicipios')->insert([
            ["codigo" => '08','municipio'=>'','iddepartamento'=>8],
        ]);
        //09 cabaña
        DB::table('svmunicipios')->insert([
            ["codigo" => '09','municipio'=>'','iddepartamento'=>9],
        ]);
        //10 San vicente
        DB::table('svmunicipios')->insert([
            ["codigo" => '10','municipio'=>'','iddepartamento'=>10],
        ]);
        //11 Usulutan
        DB::table('svmunicipios')->insert([
            ["codigo" => '11','municipio'=>'','iddepartamento'=>11],
        ]);
        //12 San miguel
        DB::table('svmunicipios')->insert([
            ["codigo" => '12','municipio'=>'','iddepartamento'=>12],
        ]);
        //13 Morazan
        DB::table('svmunicipios')->insert([
            ["codigo" => '13','municipio'=>'','iddepartamento'=>13],
        ]);
        //14 La union
        DB::table('svmunicipios')->insert([
            ["codigo" => '14','municipio'=>'','iddepartamento'=>13],
        ]);*/
    }
}
