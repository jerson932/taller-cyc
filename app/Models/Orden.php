<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;
      protected $table = 'ordenes'; // 🔹 aquí se indica la tabla correcta

    protected $fillable = [
        'numero_orden',
        'cliente_id',
        'vehiculo_id',
        'problema_reportado',
        'fecha_apertura',
        'estado',
    ];

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    // Relación con servicios (a través de orden_detalles)
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'orden_detalles')
                    ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
                    ->withTimestamps();
    }

    // Relación con productos (a través de orden_detalles)
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'orden_detalles')
                    ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
                    ->withTimestamps();
    }

    // Relación directa con la tabla orden_detalles
    public function detalles()
    {
        return $this->hasMany(OrdenDetalle::class);
    }
}
