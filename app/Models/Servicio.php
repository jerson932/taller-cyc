<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = ['nombre', 'precio_base'];

    public function ordenes()
    {
        return $this->belongsToMany(Orden::class, 'orden_detalles')
                    ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
                    ->withTimestamps();
    }
}
