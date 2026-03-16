<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear el rol Admin
        $admin = Role::create(['name' => 'Admin']);
        $vendedor = Role::create(['name' => 'Vendedor']);

        // 2. Crear Permisos (lo que pueden hacer)
        Permission::create(['name' => 'ver.clientes'])->assignRole([$admin, $vendedor]);
        Permission::create(['name' => 'eliminar.clientes'])->assignRole($admin);
        Permission::create(['name' => 'gestionar.pagos'])->syncRoles([$admin, $vendedor]);
        // Crear tu usuario
        $user = User::create([
            'name' => 'Dylan Admin',
            'cedula' => '31797925',
            'email' => 'dylan@test.com',
            'password' => bcrypt('12345678'), // Esta será tu clave
            'role' => 'Admin'
        ]);

        // Asignarte el rol
        $user->assignRole($admin);
    }
}
