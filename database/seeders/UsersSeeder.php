<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\QueryException;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['usuario' => 'admin', 'contrasenia' => 'admin123', 'correo' => 'admin@tienda.com', 'nombre' => 'Administrador'],
            ['usuario' => 'usuario', 'contrasenia' => 'password123', 'correo' => 'usuario@email.com', 'nombre' => 'Usuario Prueba'],
            ['usuario' => 'marco', 'contrasenia' => 'test12', 'correo' => 'marcocalvojimenez@gmail.com', 'nombre' => 'Administrador'],
            ['usuario' => 'marco2', 'contrasenia' => 'test12', 'correo' => 'marcocalvojimenez@gmail.com', 'nombre' => 'marco2'],
            ['usuario' => 'test', 'contrasenia' => 'test12', 'correo' => 'test@test.com', 'nombre' => 'test'],
        ];

        foreach ($users as $userData) {
            try {
                User::updateOrCreate(['usuario' => $userData['usuario']], $userData);
            } catch (QueryException $e) {
                // Si falla por correo duplicado, ajustamos el correo y reintentamos
                $userData['correo'] = $userData['usuario'].'@example.com';
                User::updateOrCreate(['usuario' => $userData['usuario']], $userData);
            }
        }
    }
}