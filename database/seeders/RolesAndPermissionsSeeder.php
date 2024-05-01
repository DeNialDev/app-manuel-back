<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear permisos
        Permission::create(['name' => 'crear proyectos']);
        Permission::create(['name' => 'editar proyectos']);
        Permission::create(['name' => 'eliminar proyectos']);

        Permission::create(['name' => 'crear tareas']);
        Permission::create(['name' => 'editar tareas']);
        Permission::create(['name' => 'eliminar tareas']);
        Permission::create(['name' => ' tareas']);

        // Crear roles y asignar permisos
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('crear proyectos');
        $adminRole->givePermissionTo('editar proyectos');
        $adminRole->givePermissionTo('eliminar proyectos');
        $adminRole->givePermissionTo('crear tareas');
        $adminRole->givePermissionTo('editar tareas');
        $adminRole->givePermissionTo('eliminar tareas');

    }
}
