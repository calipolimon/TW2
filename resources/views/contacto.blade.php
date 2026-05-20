@extends('layouts.app')

@section('content')
@php
    $mensaje = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_enviar'])) {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $texto = isset($_POST['texto']) ? trim($_POST['texto']) : '';
        if (empty($nombre)) {
            $mensaje = 'El nombre es obligatorio';
        } elseif (empty($apellidos)) {
            $mensaje = 'Los apellidos son obligatorios';
        } elseif (empty($email)) {
            $mensaje = 'El email es obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensaje = 'El email no es válido';
        } elseif (empty($texto)) {
            $mensaje = 'El mensaje es obligatorio';
        } else {
            $mensaje = 'Mensaje enviado correctamente. Nos pondremos en contacto pronto.';
        }
    }
    $limpiar = !empty($mensaje) && strpos($mensaje, 'correctamente') !== false;
@endphp

<div style="max-width: 600px; margin: 50px auto; padding: 20px;">
    <h2 style="color: #5d4e37; margin-bottom: 10px;">Contacto</h2>
    <p style="color: #666; margin-bottom: 30px;">Déjanos tu mensaje y nos pondremos en contacto lo antes posible</p>

    @if($mensaje)
        @if(strpos($mensaje, 'correctamente') !== false)
            <div style="background-color: #d4edda; border: 1px solid #28a745; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                {{ $mensaje }}
            </div>
        @else
            <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                {{ $mensaje }}
            </div>
        @endif
    @endif

    <form method="POST">
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Nombre <span style="color: red;">*</span></label>
            <input type="text" name="nombre" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ $limpiar ? '' : old('nombre', $_POST['nombre'] ?? '') }}">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Apellidos <span style="color: red;">*</span></label>
            <input type="text" name="apellidos" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ $limpiar ? '' : old('apellidos', $_POST['apellidos'] ?? '') }}">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Email <span style="color: red;">*</span></label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" value="{{ $limpiar ? '' : old('email', $_POST['email'] ?? '') }}">
        </div>
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #5d4e37; font-weight: bold; margin-bottom: 5px;">Mensaje <span style="color: red;">*</span></label>
            <textarea name="texto" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; min-height: 150px;">{{ $limpiar ? '' : old('texto', $_POST['texto'] ?? '') }}</textarea>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <button type="submit" name="btn_enviar" style="flex: 1; background-color: #a0826d; color: white; border: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 16px;">Enviar</button>
            <button type="reset" style="flex: 1; background-color: #d4c4b0; color: #5d4e37; border: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 16px;">Limpiar</button>
        </div>
    </form>
</div>
@endsection
