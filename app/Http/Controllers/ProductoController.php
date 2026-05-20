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

        $userKey = auth()->check() ? auth()->id() : 'invitado';
        $carrito = session()->get("carrito.{$userKey}", []);

        // Contamos cuántas unidades de este producto ya tenemos en la sesión
        $unidades_en_carrito = 0;
        foreach ($carrito as $item) {
            if ($item['producto_id'] == $producto->id) {
                $unidades_en_carrito++;
            }
        }

        // Si al intentar añadir 1 más superamos el stock real de la base de datos, abortamos
        if (($unidades_en_carrito + 1) > $producto->stock) {
            return redirect()->back()->with('error', 'No puedes añadir más unidades de este producto. Has alcanzado el límite de stock disponible.');
        }

        $carrito[] = [
            'producto_id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'imagen' => $producto->imagen,
            'stock'  => $producto->stock,
        ];

        session()->put("carrito.{$userKey}", $carrito);

        return redirect()->back();
    }

    public function removeFromCart($index)
    {
        $userKey = auth()->check() ? auth()->id() : 'invitado';
        $carrito = session()->get("carrito.{$userKey}", []);

        if (isset($carrito[$index])) {
            unset($carrito[$index]);
            session()->put("carrito.{$userKey}", array_values($carrito));
        }

        return redirect()->to(url()->previous() . '?carrito=abierto')->with('success', 'Producto eliminado del carrito correctamente.');
    }
}