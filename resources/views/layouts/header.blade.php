<header>
    <h1>Tienda Artesanal</h1>
</header>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #8b7355; padding: 10px 20px;">
    <div style="flex: 1; display: flex; justify-content: center; gap: 15px;">
        <a href="{{ route('inicio') }}">Inicio</a>
        <a href="{{ route('catalogo') }}">Catálogo</a>
        <a href="{{ url('/contacto') }}">Contacto</a>
        @auth
            <a href="{{ route('perfil') }}">Perfil</a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.pedidos') }}">Pedidos</a>
                <a href="{{ route('admin.stock') }}">Administración</a>
            @endif
        @endauth
    </div>
    <div style="display: flex; gap: 15px; align-items: center; position: relative;">
        @php
            $carrito = session('carrito', []);
            $cantidadCarrito = count($carrito);
        @endphp
        <label for="carrito-toggle" class="carrito-boton" title="Ver carrito">🛒 [{{ $cantidadCarrito }}]</label>
        @auth
            <span style="color: white;">Hola, {{ auth()->user()->nombre ?? auth()->user()->usuario }}</span>
            <a href="{{ route('logout') }}">Cerrar sesión</a>
        @else
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('registro') }}">Registrarse</a>
        @endauth
    </div>
</nav>

<input type="checkbox" id="carrito-toggle" style="display: none;" {{ request()->get('carrito') === 'abierto' ? 'checked' : '' }}>
<div class="carrito-panel">
    <a href="{{ route('catalogo') }}" style="display: block; text-align: right; text-decoration: none; color: #5d4e37; font-weight: bold; font-size: 18px; margin-bottom: 10px;">✕</a>
    <div class="carrito-titulo">Mi Carrito</div>
    <div class="carrito-contenido">
        @if($cantidadCarrito === 0)
            <p style="padding: 10px;">El carrito está vacío</p>
        @else
            <table style="width: 100%; border-collapse: collapse;">
                @foreach($carrito as $indice => $producto)
                    <tr style="border-bottom: 1px solid #ddd; font-size: 12px;">
                        <td style="padding: 5px;">
                            <strong>{{ $producto['nombre'] }}</strong><br>
                            ${{ number_format($producto['precio'], 2) }}
                        </td>
                        <td style="padding: 5px; text-align: center;">
                            <form method="POST" action="{{ route('carrito.remove', $indice) }}" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: #c9302c; color: white; border: none; padding: 3px 8px; cursor: pointer; font-size: 11px;">X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr style="background-color: #d4c4b0; font-weight: bold;">
                    <td colspan="2" style="padding: 8px; text-align: right;">
                        Total: ${{ number_format(collect($carrito)->sum('precio'), 2) }}
                    </td>
                </tr>
            </table>
            <div style="margin-top: 20px;">
                <a href="{{ route('checkout') }}" style="display: block; text-align: center; background-color: #28a745; color: white; padding: 10px; text-decoration: none; border-radius: 4px; font-weight: bold;">Checkout</a>
            </div>
        @endif
    </div>
</div>
