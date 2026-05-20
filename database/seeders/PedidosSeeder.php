<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\User;

class PedidosSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = [
            [
                'usuario' => 'maria',
                'correo' => 'maria@example.com',
                'direccion' => 'Calle Luna 45, Sevilla',
                'estado' => 'pendiente',
            ],
            [
                'usuario' => 'carlos',
                'correo' => 'carlos@example.com',
                'direccion' => 'Avenida Sol 12, Málaga',
                'estado' => 'enviado',
            ],
        ];

        foreach ($pedidos as $pedidoData) {
            $user = User::where('usuario', $pedidoData['usuario'])->first();

            if (!$user) {
                continue;
            }

            Pedido::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'direccion' => $pedidoData['direccion'],
                ],
                [
                    'user_id' => $user->id,
                    'correo' => $pedidoData['correo'],
                    'direccion' => $pedidoData['direccion'],
                    'estado' => $pedidoData['estado'],
                ]
            );
        }
    }
}
