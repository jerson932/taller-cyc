<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function byMarca(Marca $marca)
    {
        // Devuelve solo lo necesario y ordenado
        return $marca->modelos()
            ->select('id', 'nombre')
            ->orderBy('nombre')
            ->get();
    }
}