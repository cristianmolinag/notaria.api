<?php

use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class Install extends Seeder
{

    public function run()
    {

        $perfilC = new Perfil();
        $perfilC->nombre = 'Cliente';
        $perfilC->save();

        $perfilF = new Perfil();
        $perfilF->nombre = 'Funcionario';
        $perfilF->save();

        $usuario = new Usuario();
        $usuario->correo = "admin@correo.com";
        $usuario->contrasena = Hash::make('123');
        $usuario->nombres = "Administrador";
        $usuario->apellidos = "Administrador";
        $usuario->perfil_id = $perfilF->id;
        $usuario->remember_token = str_random(32);
        $usuario->estado = 1;
        $usuario->save();

    }
}
