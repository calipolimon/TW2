<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('catalogo'));
        }

        return back()->withErrors(['usuario' => 'Usuario o contraseña incorrectos'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.registro');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'usuario' => ['required', 'string', 'max:255', 'unique:users,usuario'],
            'correo' => ['required', 'email', 'max:255', 'unique:users,correo'],
            'contrasenia' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'usuario' => $data['usuario'],
            'contrasenia' => $data['contrasenia'],
            'correo' => $data['correo'],
            'nombre' => $data['usuario'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('catalogo');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }

    public function profile()
    {
        return view('perfil_usuario', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', 'unique:users,correo,' . $user->id],
            'contrasenia' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $user->nombre = $data['nombre'];
        $user->correo = $data['correo'];

        if (!empty($data['contrasenia'])) {
            $user->contrasenia = $data['contrasenia'];
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}