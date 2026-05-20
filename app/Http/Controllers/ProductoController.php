<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    // CATÁLOGO (equivalente a procesar_productos.php)
    public function index(Request $request)
    {
        $categoria = $request->get('cat', 'Todas');

        $query = Producto::query();

        if ($categoria !== 'Todas') {
            $query->where('categoria', $categoria);
        }

        $productos = $query->get();
        // Obtener las categorías existentes para mostrarlas en la vista
        $categorias = Producto::select('categoria')->distinct()->orderBy('categoria')->pluck('categoria');

        return view('catalogo', compact('productos', 'categoria', 'categorias'));
    }

    // DETALLE PRODUCTO
    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        return view('detalle_producto', compact('producto'));
    }

    // AÑADIR AL CARRITO (antes POST en procesar_productos.php)
    public function addToCart(Request $request)
    {
        $request->validate([
            'producto_id' => ['required', 'integer', 'exists:productos,id'],
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->stock <= 0) {
            return redirect()->back()->with('error', 'No hay stock disponible para este producto.');
        }

        $carrito = session()->get('carrito', []);

        $carrito[] = [
            'producto_id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'imagen' => $producto->imagen,
            'stock'  => $producto->stock,
        ];

        session()->put('carrito', $carrito);

        return redirect()->back();
    }

    public function removeFromCart($index)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$index])) {
            unset($carrito[$index]);
            session()->put('carrito', array_values($carrito));
        }

        return redirect()->back();
    }
}