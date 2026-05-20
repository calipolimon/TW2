@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; border: 1px solid #ddd;">
    <h2 style="color: #5d4e37; margin-bottom: 30px;">Mi Perfil</h2>

    @if(session('success'))
        <div style="background-color: #d4edda; border: 1px solid #28a745; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

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
        <p style="margin: 0;">
            <strong>Usuario:</strong> {{ auth()->user()->usuario }}<br>
            <strong>Rol:</strong> {{ auth()->user()->isAdmin() ? 'Admin' : 'Usuario' }}
        </p>
    </div>

    <form method="POST" action="{{ route('perfil.update') }}">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Nombre <span style="color: red;">*</span></label>
            <input type="text" name="nombre" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('nombre', auth()->user()->nombre) }}">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Correo <span style="color: red;">*</span></label>
            <input type="email" name="correo" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('correo', auth()->user()->correo) }}">
        </div>
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #eee;">
            <h4 style="color: #5d4e37; margin-top: 0;">Cambiar Contraseña (opcional)</h4>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Nueva Contraseña</label>
                <input type="password" name="contrasenia" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                <small style="color: #999;">Déjalo vacío si no quieres cambiarla</small>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Confirmar Contraseña</label>
                <input type="password" name="contrasenia_confirmation" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>
        <button type="submit" style="width: 100%; background-color: #a0826d; color: white; border: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 16px;">Actualizar Perfil</button>
    </form>
    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('catalogo') }}" style="color: #a0826d; text-decoration: none;">← Volver al catálogo</a>
    </div>
</div>
@endsection
