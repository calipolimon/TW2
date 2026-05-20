@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 30px 20px; background: white; border-radius: 8px; border: 1px solid #ddd;">
    <h1 style="color: #5d4e37; margin-bottom: 30px;">Administración de Tienda</h1>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 3px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;">
        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; flex: 1; min-width: 240px;">
            <h3 style="color: #5d4e37; margin: 0 0 10px 0;">Total Productos</h3>
            <p style="font-size: 28px; color: #a0826d; margin: 0;">{{ $productos->count() }}</p>
        </div>
        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; flex: 1; min-width: 240px;">
            <h3 style="color: #5d4e37; margin: 0 0 10px 0;">Valor Inventario</h3>
            <p style="font-size: 28px; color: #a0826d; margin: 0;">${{ number_format($productos->sum(fn($producto) => $producto->precio), 2) }}</p>
        </div>
    </div>

    <h2 style="color: #5d4e37; margin-top: 30px; margin-bottom: 20px;">Gestión de Productos</h2>
    <table style="width: 100%; border-collapse: collapse; background: white;">
        <thead>
            <tr style="background-color: #a0826d; color: white;">
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Producto</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Precio</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Stock</th>
                <th style="padding: 12px; text-align: center; border: 1px solid #ddd;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $producto->nombre }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">${{ number_format($producto->precio, 2) }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $producto->stock }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                        <a href="{{ route('admin.producto.edit', $producto->id) }}" style="background-color: #007bff; color: white; border: none; padding: 8px 12px; border-radius: 4px; text-decoration: none;">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 20px; text-align: center; color: #666;">No hay productos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 40px; background: #f9f9f9; padding: 20px; border-radius: 5px;">
        <h2 style="color: #5d4e37; margin-top: 0;">Resumen de Inventario</h2>
        <p style="color: #666;">
            Los productos se administran directamente en la base de datos.
        </p>
        <ul style="color: #666; line-height: 1.8; padding-left: 1rem;">
            <li><strong>Total de productos en catálogo:</strong> {{ $productos->count() }}</li>
            <li><strong>Valor total inventario:</strong> ${{ number_format($productos->sum(fn($producto) => $producto->precio), 2) }}</li>
            <li><strong>Sistema de carro:</strong> Sesión Laravel</li>
            <li><strong>Gestión de inventario:</strong> Base de datos MySQL/SQLite</li>
        </ul>
    </div>
</div>
@endsection
