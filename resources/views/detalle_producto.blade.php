@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 50px auto; padding: 20px;">
    <div style="display: flex; gap: 30px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" style="width: 100%; border-radius: 8px;">
        </div>
        <div style="flex: 1; min-width: 300px;">
            <h2 style="color: #5d4e37; margin-bottom: 20px;">{{ $producto->nombre }}</h2>
            <div style="background-color: #d4c4b0; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <p style="font-size: 24px; color: #5d4e37; margin: 0;">
                    <strong>${{ number_format($producto->precio, 2) }}</strong>
                </p>
                <p style="color: #666; margin: 5px 0 0 0;">
                    @if($producto->stock <= 0)
                        <strong style="color: #d9534f;">Agotado</strong>
                    @else
                        Stock disponible: <strong>{{ $producto->stock }}</strong>
                    @endif
                </p>
            </div>
            <div style="margin-bottom: 30px;">
                <h3 style="color: #5d4e37; margin-bottom: 10px;">Descripción</h3>
                <p style="color: #666; line-height: 1.6;">{{ $producto->descripcion }}</p>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <form method="POST" action="{{ route('carrito.add') }}" style="flex: 1; min-width: 200px;">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    @if($producto->stock > 0)
                        <button type="submit" class="btn btn-primary w-100">Añadir al Carrito</button>
                    @else
                        <button type="button" disabled class="btn btn-secondary w-100">Agotado</button>
                    @endif
                </form>
                <a href="{{ route('catalogo') }}" class="btn btn-outline-secondary flex-fill d-flex align-items-center justify-content-center" style="min-width: 200px; text-decoration: none;">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
