<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Modelo extends Model
{
    protected $fillable = ['nombre', 'marca_id'];

  Public function marca()
{
    return $this->belongsTo(\App\Models\Marca::class);
}
}