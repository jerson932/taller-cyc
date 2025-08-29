<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    protected $fillable = [
        'orden_id', 'servicio_id', 'producto_id',
        'cantidad', 'precio_unitario', 'subtotal'
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

