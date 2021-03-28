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
        DB::table('area')->insert(['nombre' => 'Tacambaro']);
        // -    *   Asignar usuarios a roles
        DB::table('root')->insert(['nombre' => 'Root', 'apellido_paterno'=>'Lorem',"apellido_materno" => "Ipsum", "id_usuario"=>"1"]);
        DB::table('admin')->insert(['nombre' => 'Administrador', 'apellido_paterno'=>'Set',"apellido_materno" => "", "id_usuario"=>"2","id_area"=>"1"]);
        DB::table('usuario')->insert(['nombre' => 'Brandon', 'apellido_paterno'=>'Rodriguez',"apellido_materno" => "Molina", "id_usuario"=>"3","id_area"=>"1"]);

    }
}
