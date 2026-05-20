@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; border: 1px solid #ddd;">
    <h2 style="text-align: center; color: #5d4e37; margin-bottom: 30px;">Iniciar Sesión</h2>

    @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 3px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #5d4e37; font-weight: bold;">Usuario</label>
            <input type="text" name="usuario" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box;" value="{{ old('usuario') }}">
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #5d4e37; font-weight: bold;">Contraseña</label>
            <input type="password" name="password" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box;">
        </div>
        <button type="submit" style="width: 100%; background-color: #a0826d; color: white; padding: 10px; border: none; border-radius: 3px; font-weight: bold; cursor: pointer;">Iniciar Sesión</button>
    </form>
    <div style="margin-top: 20px; text-align: center; color: #666; font-size: 14px;">
        <p>¿No tienes cuenta? <a href="{{ route('registro') }}" style="color: #a0826d; text-decoration: none; font-weight: bold;">Regístrate aquí</a></p>
    </div>
</div>
@endsection
