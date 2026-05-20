@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 0 auto; padding: 30px 20px; background: white; border-radius: 8px; border: 1px solid #ddd;">
    <h1 style="color: #5d4e37; margin-bottom: 30px;">Gestión de Pedidos</h1>

    @if(session('success'))
        <div style="background-color: #d4edda; border: 1px solid #28a745; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($pedidos->isEmpty())
        <div style="background-color: #e2e3e5; color: #383d41; padding: 20px; border-radius: 4px; text-align: center;">
            <p>No hay pedidos registrados</p>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($pedidos as $pedido)
                <div style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 4px; padding: 20px;">
                    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 15px; margin-bottom: 15px;">
                        <div>
                            <p style="margin: 5px 0; color: #666; font-size: 12px;">Usuario</p>
                            <p style="margin: 0; color: #5d4e37; font-weight: bold;">{{ $pedido->user->usuario ?? 'Invitado' }}</p>
                        </div>
                        <div>
                            <p style="margin: 5px 0; color: #666; font-size: 12px;">Correo</p>
                            <p style="margin: 0; color: #5d4e37;">{{ $pedido->correo }}</p>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <p style="margin: 5px 0; color: #666; font-size: 12px;">Dirección</p>
                        <p style="margin: 0; color: #5d4e37;">{{ $pedido->direccion }}</p>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                        <form method="POST" action="{{ route('admin.pedidos.update', $pedido) }}" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                            @csrf
                            <select name="estado" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; background-color: white;">
                                <option value="pendiente" {{ $pedido->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="cancelado" {{ $pedido->estado === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                <option value="enviado" {{ $pedido->estado === 'enviado' ? 'selected' : '' }}>Enviado</option>
                                <option value="finalizado" {{ $pedido->estado === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                            <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Actualizar</button>
                        </form>
                        @php
                            $estadoColor = '#6c757d';
                            if ($pedido->estado === 'pendiente') $estadoColor = '#ffc107';
                            elseif ($pedido->estado === 'cancelado') $estadoColor = '#dc3545';
                            elseif ($pedido->estado === 'enviado') $estadoColor = '#17a2b8';
                            elseif ($pedido->estado === 'finalizado') $estadoColor = '#28a745';
                        @endphp
                        <span style="padding: 8px 15px; background-color: {{ $estadoColor }}; color: white; border-radius: 4px; font-size: 12px; font-weight: bold;">
                            {{ ucfirst($pedido->estado) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
