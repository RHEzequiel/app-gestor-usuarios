<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar usuarios existentes primero
        User::truncate();
        
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'role' => 'administrador',
            'email_verified_at' => now(),
        ]);

        // Crear usuario profesor
        User::create([
            'name' => 'Profesor Demo',
            'email' => 'profesor@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'profesor',
            'phone' => '123456789',
            'email_verified_at' => now(),
        ]);

        // Crear usuario alumno
        User::create([
            'name' => 'Alumno Demo',
            'email' => 'alumno@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'alumno',
            'phone' => '987654321',
            'email_verified_at' => now(),
        ]);
        
        // Crear más alumnos para poder buscar
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'alumno',
            'phone' => '1123456789',
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => 'María García',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'alumno',
            'phone' => '1145678901',
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => 'Carlos López',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'alumno',
            'phone' => '1167890123',
            'email_verified_at' => now(),
        ]);
    }
}
