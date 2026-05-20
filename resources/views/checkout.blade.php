@extends('layouts.app')

@section('content')
@php
    $cart = session('carrito', []);
@endphp

@if(session('success'))
    <div style="max-width: 600px; margin: 100px auto; padding: 20px; text-align: center;">
        <div style="background-color: #d4edda; border: 2px solid #28a745; color: #155724; padding: 30px; border-radius: 8px;">
            <h2 style="margin: 0 0 15px 0;">✓ Pago Procesado</h2>
            <p style="margin: 10px 0 15px 0; font-size: 18px;">Aquí se procesó tu pedido correctamente.</p>
            <p style="margin: 10px 0;">Total pagado: <strong>${{ number_format(session('total'), 2) }}</strong></p>
            <p style="margin: 10px 0; font-size: 14px; color: #666;">Número de pedido: #{{ session('order_id') }}</p>
            <a href="{{ route('catalogo') }}" style="display: inline-block; background-color: #28a745; color: white; padding: 12px 30px; text-decoration: none; border-radius: 4px; margin-top: 20px;">Volver al Catálogo</a>
        </div>
    </div>
@elseif(count($cart) === 0)
    <div style="max-width: 600px; margin: 100px auto; padding: 20px; text-align: center;">
        <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 30px; border-radius: 8px;">
            <p style="margin: 0;">Tu carrito está vacío. Agrega productos antes de continuar al pago.</p>
            <a href="{{ route('catalogo') }}" style="display: inline-block; background-color: #a0826d; color: white; padding: 12px 30px; text-decoration: none; border-radius: 4px; margin-top: 20px;">Ver Catálogo</a>
        </div>
    </div>
@else
    <div style="max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; border: 1px solid #ddd;">
        <h2 style="color: #5d4e37; margin-bottom: 30px;">Completar Compra</h2>

        @if($errors->any())
            <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background-color: #d4c4b0; padding: 15px; border-radius: 4px; margin-bottom: 30px;">
            <p style="margin: 0; color: #5d4e37;">
                <strong>Resumen del Pedido:</strong><br>
                Productos: {{ count($cart) }}<br>
                Total: <strong>${{ number_format(collect($cart)->sum('precio'), 2) }}</strong>
            </p>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Nombre <span style="color: red;">*</span></label>
                <input type="text" name="nombre" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('nombre') }}">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Apellidos <span style="color: red;">*</span></label>
                <input type="text" name="apellidos" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('apellidos') }}">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Email <span style="color: red;">*</span></label>
                <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('email', auth()->user()->correo) }}">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Dirección <span style="color: red;">*</span></label>
                <textarea name="direccion" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; min-height: 80px;">{{ old('direccion') }}</textarea>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" style="flex: 1; background-color: #28a745; color: white; border: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 16px;">Pagar</button>
                <a href="{{ route('catalogo') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; background-color: #999; color: white; text-decoration: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 16px;">Volver</a>
            </div>
        </form>
    </div>
@endif
@endsection
