<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\DetalleOrdenController;
use App\Http\Controllers\ModeloController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas principales de recursos
Route::resource('clientes', ClienteController::class);
Route::resource('vehiculos', VehiculoController::class);
Route::resource('ordenes', OrdenController::class)->parameters([
    'ordenes' => 'orden'
]);
Route::resource('servicios', ServicioController::class);
Route::resource('pagos', PagoController::class);
Route::resource('detalles', DetalleOrdenController::class);

// API para obtener modelos por marca (AJAX)
Route::get('/api/modelos/{marca}', [ModeloController::class, 'byMarca'])
    ->name('modelos.byMarca');

// API para obtener vehículos de un cliente
Route::get('/clientes/{id}/vehiculos', [ClienteController::class, 'vehiculos'])
    ->name('clientes.vehiculos');

