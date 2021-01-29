<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('users')->insert([
            [
                "name" => 'Supervisor',
                "email" => 'supervisor@ae-energiasolar.com',
                "password" => 'eyJpdiI6ImVWd2VETWt2amROT05kbUtFdDEzRmc9PSIsInZhbHVlIjoiSmcwWDhWdHRJc3FoN1RHSnJWcWZYQT09IiwibWFjIjoiMDVjYWZkM2U0MWZiNjkwYWE1MTZhMmRjNWY5MGVhOWZiNzVjZGY4MWM3YTQyMzBmOWJkYTdkNTA4OTgxYTg2OSJ9',
                "foto" => 'fotoperfil/perfilDefault.jpg',
                "idrol" => 1,
                "estado" => true
            ]
        ]);
    }
}
