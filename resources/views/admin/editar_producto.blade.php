@extends('layouts.app')

@section('content')
<div style="max-width: 700px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; border: 1px solid #ddd;">
    <h2 style="color: #5d4e37; margin-bottom: 30px;">Editar Producto</h2>

    @if($errors->any())
        <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.producto.update', $producto->id) }}">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Nombre</label>
            <input type="text" name="nombre" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('nombre', $producto->nombre) }}">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Precio</label>
            <input type="number" step="0.01" name="precio" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('precio', $producto->precio) }}">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Stock</label>
            <input type="number" name="stock" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('stock', $producto->stock) }}">
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Descripción</label>
            <textarea name="descripcion" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; min-height: 120px;">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>
        <button type="submit" style="background-color: #5d4e37; color: white; border: none; padding: 12px 20px; border-radius: 4px; cursor: pointer;">Guardar Cambios</button>
        <a href="{{ route('admin.stock') }}" style="margin-left: 10px; color: #a0826d; text-decoration: none;">Cancelar</a>
    </form>
</div>
@endsection
