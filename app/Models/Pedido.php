<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pedido extends Model
{
    use HasFactory;

    /**
     * Tabla asociada
     */
    protected $table = 'pedidos';

    /**
     * Campos asignables
     */
    protected $fillable = [
        'user_id',
        'correo',
        'direccion',
        'estado',
    ];

    /**
     * Casts opcionales
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * RELACIÓN: el pedido pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}