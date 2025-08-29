<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory; // 👈 importante para usar factories si luego quieres seeders

    protected $fillable = ['nombre', 'precio_base', 'stock', 'imagen'];

    public function ordenes()
    {
        return $this->belongsToMany(Orden::class, 'orden_detalles')
                    ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
                    ->withTimestamps();
    }
}
