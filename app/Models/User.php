<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pedido;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos asignables
     */
    protected $fillable = [
        'usuario',
        'contrasenia',
        'correo',
        'nombre',
    ];

    /**
     * Campos ocultos (seguridad)
     */
    protected $hidden = [
        'contrasenia',
        'remember_token',
    ];

    /**
     * Casts automáticos
     */
    protected $casts = [
        'contrasenia' => 'hashed',
    ];

    /**
     * Retorna la contraseña para el guard auth
     */
    public function getAuthPassword()
    {
        return $this->contrasenia;
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['contrasenia'] = $value;
    }

    /**
     * RELACIÓN: un usuario tiene muchos pedidos
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function isAdmin(): bool
    {
        return $this->usuario === 'admin';
    }
}