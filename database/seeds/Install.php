<?php

use App\Models\EstadoTramite;
use App\Models\Perfil;
use App\Models\Permiso;
use App\Models\PermisoRol;
use App\Models\Rol;
use App\Models\TipoTramite;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use Illuminate\Database\Seeder;

class Install extends Seeder
{

    public function run()
    {
        // Creacion de perfiles

        $perfilC = new Perfil();
        $perfilC->nombre = 'Cliente';
        $perfilC->save();

        $perfilF = new Perfil();
        $perfilF->nombre = 'Funcionario';
        $perfilF->save();

        //Creacion de usuario Administrador

        $usuario = new Usuario();
        $usuario->correo = "admin@correo.com";
        $usuario->contrasena = Hash::make('123');
        $usuario->nombres = "Administrador";
        $usuario->apellidos = "Administrador";
        $usuario->perfil_id = $perfilF->id;
        $usuario->remember_token = str_random(32);
        $usuario->estado = 1;
        $usuario->save();

        //Creación de permisos

        Permiso::create(['titulo' => 'Configuracion', 'componente' => 'ConfiguracionPage']);
        Permiso::create(['titulo' => 'Usuarios', 'componente' => 'UsuariosPage']);
        Permiso::create(['titulo' => 'Registro Civil de Nacimiento', 'componente' => 'RegistroCivilNacimientoPage']);
        Permiso::create(['titulo' => 'Registro Civil de Matrimonio', 'componente' => 'RegistroCivilMatrimonioPage']);
        Permiso::create(['titulo' => 'Registro Civil de Defunción', 'componente' => 'RegistroCivilDefuncionPage']);
        Permiso::create(['titulo' => 'Consultas', 'componente' => 'ConsultasPage']);
        Permiso::create(['titulo' => 'Tramites', 'componente' => 'TramitesPage']);
        Permiso::create(['titulo' => 'Citas', 'componente' => 'CitasPage']);

        //Creacion de roles

        //Asignacion de rol y permisos Admin
        $rolA = Rol::create(['nombre' => 'Administrador']);
        UsuarioRol::create(['usuario_id' => $usuario->id, 'rol_id' => $rolA->id]);
        $permisosA = Permiso::All();
        foreach ($permisosA as $permisoA) {
            PermisoRol::create(['permiso_id' => $permisoA->id, 'rol_id' => $rolA->id]);
        }

        //Asignacion de rol y permisos Cliente
        $rol = Rol::create(['nombre' => 'Cliente']);
        $permisos = Permiso::whereIn('componente', ['TramitesPage', 'CitasPage', 'UsuariosPage'])->get();
        foreach ($permisos as $permiso) {
            PermisoRol::create(['permiso_id' => $permiso->id, 'rol_id' => $rol->id]);
        }

        // Asignacion de permisos a Rol Secretario
        $rol = Rol::create(['nombre' => 'Secretario']);
        $permisos = Permiso::whereIn('componente', ['ConsultasPage', 'TramitesPage', 'CitasPage', 'RegistroCivilNacimientoPage', 'RegistroCivilMatrimonioPage', 'RegistroCivilDefuncionPage', 'UsuariosPage'])->get();
        foreach ($permisos as $permiso) {
            PermisoRol::create(['permiso_id' => $permiso->id, 'rol_id' => $rol->id]);
        }

        // // Asignacion de permisos a Rol Notario

        $rol = Rol::create(['nombre' => 'Notario']);
        $permisos = Permiso::whereIn('componente', ['ConsultasPage', 'TramitesPage', 'CitasPage', 'RegistroCivilNacimientoPage', 'RegistroCivilMatrimonioPage', 'RegistroCivilDefuncionPage', 'UsuariosPage'])->get();
        foreach ($permisos as $permiso) {
            PermisoRol::create(['permiso_id' => $permiso->id, 'rol_id' => $rol->id]);
        }

        // Crear estados de tramite

        EstadoTramite::create(['nombre' => 'Pendiente']);
        EstadoTramite::create(['nombre' => 'Autorizado']);
        EstadoTramite::create(['nombre' => 'Rechazado']);

        // Crear tipos de tramite
        TipoTramite::create(['nombre' => 'Duplicado', 'valor' => 3000]);

    }
}
