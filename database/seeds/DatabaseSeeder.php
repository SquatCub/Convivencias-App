<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // -    *   Usuarios
        DB::table('users')->insert(['usuario' => 'root','password' => bcrypt('root')]);
        DB::table('users')->insert(['usuario' => 'admin','password' => bcrypt('admin')]);
        DB::table('users')->insert(['usuario' => 'usuario','password' => bcrypt('usuario')]);
        // -    *   Areas
        DB::table('area')->insert(['nombre' => 'Morelia']);
        DB::table('area')->insert(['nombre' => 'Zinapécuaro']);
        DB::table('area')->insert(['nombre' => 'Maravatío']);
        DB::table('area')->insert(['nombre' => 'Zamora']);
        DB::table('area')->insert(['nombre' => 'Sahuayo/Jiquilpan']);
        DB::table('area')->insert(['nombre' => 'Zitácuaro']);
        DB::table('area')->insert(['nombre' => 'Cd. Hidalgo']);
        DB::table('area')->insert(['nombre' => 'Tuzantla']);
        DB::table('area')->insert(['nombre' => 'Huetamo']);
        DB::table('area')->insert(['nombre' => 'Uruapan']);
        DB::table('area')->insert(['nombre' => 'Los Reyes']);
        DB::table('area')->insert(['nombre' => 'La Piedad']);
        DB::table('area')->insert(['nombre' => 'Puruándiro']);
        DB::table('area')->insert(['nombre' => 'Apatzingán']);
        DB::table('area')->insert(['nombre' => 'Lázaro Cárdenas']);
        // -    *   Asignar usuarios a roles
        DB::table('root')->insert(['nombre' => 'Root', 'apellido_paterno'=>'Lorem',"apellido_materno" => "Ipsum", "id_usuario"=>"1"]);
        DB::table('admin')->insert(['nombre' => 'Administrador', 'apellido_paterno'=>'Set',"apellido_materno" => "", "id_usuario"=>"2","id_area"=>"1"]);
        DB::table('usuario')->insert(['nombre' => 'Brandon', 'apellido_paterno'=>'Rodriguez',"apellido_materno" => "Molina", "id_usuario"=>"3","id_area"=>"1", "telefono"=>"4591084749", "edad"=>"19", "sexo"=>"M", "centro_trabajo"=>"IMSS"]);

    }
}
