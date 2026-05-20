<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Bol de cerámica',
                'precio' => 119.07,
                'imagen' => 'https://images.unsplash.com/photo-1555885456-f49342458b4c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'descripcion' => 'Inspiración artesanal: pieza rústica captada en mercado local.',
                'stock' => 0,
                'categoria' => 'Ceramica',
            ],
            [
                'nombre' => 'Camiseta Algodón Tejido',
                'precio' => 30.00,
                'imagen' => 'https://plus.unsplash.com/premium_photo-1673356301514-2cad91907f74?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'descripcion' => 'Prenda de algodón con fibras naturales y diseño relajado.',
                'stock' => 10,
                'categoria' => 'Textiles',
            ],
            [
                'nombre' => 'Sillas de Madera Tallada',
                'precio' => 35.00,
                'imagen' => 'https://images.pexels.com/photos/5608070/pexels-photo-5608070.jpeg',
                'descripcion' => 'Sillas de madera tratada con acabado artesanal rústico.',
                'stock' => 7,
                'categoria' => 'Madera',
            ],
            [
                'nombre' => 'Panel Mural Decorativo',
                'precio' => 28.00,
                'imagen' => 'https://images.pexels.com/photos/3962280/pexels-photo-3962280.jpeg?auto=compress&cs=tinysrgb&w=300',
                'descripcion' => 'Mural de texturas aplicado a mano con cal natural.',
                'stock' => 0,
                'categoria' => 'Decoracion',
            ],
            [
                'nombre' => 'Cuadros de Arte Urbano',
                'precio' => 22.00,
                'imagen' => 'https://live.staticflickr.com/2617/4100417338_541a327329_b.jpg',
                'descripcion' => 'Composición de arte contemporáneo con detalles únicos.',
                'stock' => 15,
                'categoria' => 'Decoracion',
            ],
            [
                'nombre' => 'Mochila de cuero',
                'precio' => 32.00,
                'imagen' => 'https://images.pexels.com/photos/1231059/pexels-photo-1231059.jpeg',
                'descripcion' => 'Mochila de cuero genuino con acabado artesanal.',
                'stock' => 2,
                'categoria' => 'Decoracion',
            ],
            [
                'nombre' => 'Peluche hecho a mano',
                'precio' => 20.00,
                'imagen' => 'https://images.pexels.com/photos/34402751/pexels-photo-34402751.jpeg',
                'descripcion' => 'Peluche hecho a mano con materiales de calidad.',
                'stock' => 10,
                'categoria' => 'Decoracion',
            ],
            [
                'nombre' => 'Cesta de mimbre',
                'precio' => 27.00,
                'imagen' => 'https://images.pexels.com/photos/27330697/pexels-photo-27330697.jpeg',
                'descripcion' => 'Cesta de mimbre tejida a mano.',
                'stock' => 7,
                'categoria' => 'Decoracion',
            ],
            [
                'nombre' => 'Vaso Cerámico de Campo',
                'precio' => 18.00,
                'imagen' => 'https://picsum.photos/seed/vaso-ceramica/300/200',
                'descripcion' => 'Vaso rústico que captura la esencia del paisaje campestre.',
                'stock' => 20,
                'categoria' => 'Ceramica',
            ],
        ];

        foreach ($productos as $productoData) {
            Producto::updateOrCreate(['nombre' => $productoData['nombre']], $productoData);
        }
    }
}
