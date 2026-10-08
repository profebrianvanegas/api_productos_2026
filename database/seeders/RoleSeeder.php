<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Limpiar caché de permisos app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // 2. Crear Roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $clienteRole = Role::firstOrCreate(['name' => 'Cliente']);
        // 3. Crear Usuario Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@tienda.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->assignRole($adminRole);
        // 4. Crear Usuario Cliente
        $cliente = User::firstOrCreate(
            ['email' => 'cliente@tienda.com'],
            [
                'name' => 'Cliente Frecuente',
                'password' => Hash::make('password123'),
            ]
        );
        $cliente->assignRole($clienteRole);
    }
}
