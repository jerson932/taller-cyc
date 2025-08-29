<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente (store/update)
    protected $fillable = [
        'nombre',
        'telefono',
        'email',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class);
    }
}
