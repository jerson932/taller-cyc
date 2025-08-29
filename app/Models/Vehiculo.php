<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
     'marca_id',
    'modelo_id',
    'anio',
    'color',
    'cliente_id',
    'fecha_ingreso',
    'detalle', // 👈 cambiar aquí
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
    ];

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Relación con modelo
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
