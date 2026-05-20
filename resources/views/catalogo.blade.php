@extends('layouts.app')

@section('content')
<div class="row" style="margin: 0;">
    <div class="col-md-2">
        <div class="sidebar">
            <h4>Categorías</h4>
            <a href="{{ route('catalogo', ['cat' => 'Todas']) }}" class="{{ $categoria === 'Todas' ? 'fw-bold' : '' }}">Todas</a><br>
            @if(isset($categorias) && $categorias->isNotEmpty())
                @foreach($categorias as $cat)
                    <a href="{{ route('catalogo', ['cat' => $cat]) }}" class="{{ $categoria === $cat ? 'fw-bold' : '' }}">{{ $cat }}</a><br>
                @endforeach
            @endif
        </div>
    </div>

    <div class="col-md-10">
        <h2>Nuestros Productos</h2>
        <div class="row">
            @if(isset($productos) && $productos->isNotEmpty())
                @foreach($productos as $producto)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}" style="height: 220px; object-fit: cover; border-bottom: 1px solid #ddd;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" style="color: #5d4e37;">{{ $producto->nombre }}</h5>
                                <p class="card-text text-muted" style="flex: 1;">{{ Str::limit($producto->descripcion, 100) }}</p>
                                <p class="fw-bold text-success">$ {{ number_format($producto->precio, 2) }}</p>
                                <p class="mb-2">Stock: {{ $producto->stock }}</p>
                                <div class="d-flex gap-2 mt-auto">
                                    <a href="{{ route('producto.detalle', $producto->id) }}" class="btn btn-outline-primary btn-sm">Ver detalle</a>
                                    <form method="POST" action="{{ route('carrito.add') }}" class="d-inline-flex flex-fill">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                        <button type="submit" class="btn {{ $producto->stock <= 0 ? 'btn-danger' : 'btn-primary' }} btn-sm flex-fill" @if($producto->stock <= 0) disabled @endif>
                                            @if($producto->stock <= 0) Agotado @else Añadir al carrito @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No se encontraron productos para esta categoría.
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
