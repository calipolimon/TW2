@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; border: 1px solid #ddd;">
    <h2 style="color: #5d4e37; margin-bottom: 30px; text-align: center;">Crear Cuenta</h2>

    @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Usuario <span style="color: red;">*</span></label>
            <input type="text" name="usuario" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('usuario') }}">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Correo <span style="color: red;">*</span></label>
            <input type="email" name="correo" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ old('correo') }}">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Contraseña <span style="color: red;">*</span></label>
            <input type="password" name="contrasenia" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Confirmar Contraseña <span style="color: red;">*</span></label>
            <input type="password" name="contrasenia_confirmation" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>
        <button type="submit" style="width: 100%; background-color: #a0826d; color: white; border: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 16px; margin-bottom: 10px;">Registrarse</button>
    </form>
    <div style="text-align: center; color: #666;">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}" style="color: #a0826d; text-decoration: none; font-weight: bold;">Inicia sesión aquí</a>
    </div>
</div>
@endsection
