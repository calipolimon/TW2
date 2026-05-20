<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Producto;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $cart = session()->get('carrito', []);

        if (empty($cart)) {
            return redirect()->route('catalogo')->with('error', 'Tu carrito está vacío. Agrega productos antes de pagar.');
        }

        return view('checkout', ['cart' => $cart]);
    }

    public function process(Request $request)
    {
        $cart = session()->get('carrito', []);

        if (empty($cart)) {
            return redirect()->route('catalogo')->with('error', 'Tu carrito está vacío.');
        }

        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'direccion' => ['required', 'string'],
        ]);

        $user = Auth::user();
        $counts = [];
        foreach ($cart as $item) {
            $counts[$item['producto_id']] = ($counts[$item['producto_id']] ?? 0) + 1;
        }

        $productos = Producto::whereIn('id', array_keys($counts))->get()->keyBy('id');

        foreach ($counts as $productoId => $cantidad) {
            $producto = $productos->get($productoId);
            if (!$producto || $producto->stock < $cantidad) {
                return back()->withErrors(['stock' => 'No hay suficiente stock para algunos productos en tu carrito.'])->withInput();
            }
        }

        $pedido = Pedido::create([
            'user_id' => $user->id,
            'correo' => $data['email'],
            'direccion' => $data['direccion'],
            'estado' => 'pendiente',
        ]);

        foreach ($counts as $productoId => $cantidad) {
            $producto = $productos->get($productoId);
            $producto->decrement('stock', $cantidad);
        }

        $total = collect($cart)->sum('precio');

        session()->forget('carrito');

        return redirect()->route('checkout')->with([
            'success' => 'Pago procesado correctamente. Tu pedido ha sido registrado.',
            'total' => $total,
            'order_id' => $pedido->id,
        ]);
    }
}
