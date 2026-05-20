<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function authorizeAdmin()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }
    }

    public function stock()
    {
        $this->authorizeAdmin();

        $productos = Producto::all();
        
        // Calculamos de forma agregada el sumatorio de precio * stock de cada artículo (Punto 8)
        $valor_inventario = Producto::sum(\DB::raw('precio * stock'));

        return view('admin.administracion_stock', compact('productos', 'valor_inventario'));
    }

    public function edit($id)
    {
        $this->authorizeAdmin();

        $producto = Producto::findOrFail($id);

        return view('admin.editar_producto', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $producto = Producto::findOrFail($id);
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $producto->update($data);

        return redirect()->route('admin.stock')->with('success', 'Producto actualizado');
    }

    public function pedidos()
    {
        $this->authorizeAdmin();

        $pedidos = Pedido::with('user')->get();

        return view('admin.gestion_pedidos', compact('pedidos'));
    }

    public function updatePedidoStatus(Request $request, Pedido $pedido)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'estado' => ['required', 'in:pendiente,cancelado,enviado,finalizado'],
        ]);

        $pedido->update(['estado' => $data['estado']]);

        return redirect()->route('admin.pedidos')->with('success', 'Estado actualizado correctamente');
    }
}