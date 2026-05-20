<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * Tabla asociada
     */
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'precio',
        'imagen',
        'descripcion',
        'stock',
        'categoria',
    ];

    /**
     * Casts opcionales
     */
    protected $casts = [
        'precio' => 'float',
        'stock' => 'integer',
    ];
}