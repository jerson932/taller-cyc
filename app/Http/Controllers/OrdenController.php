<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index()
    {
         $ordenes = Orden::with(['cliente', 'vehiculo.marca', 'vehiculo.modelo'])
        ->paginate(10); // en lugar de get()
        
    return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
    $vehiculos = Vehiculo::with(['marca', 'modelo'])->get();

    return view('ordenes.create', compact('clientes', 'vehiculos'));   
    }

    public function store(Request $request)
    {
          $validated = $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'problema_reportado' => 'required|string',
        'fecha_apertura' => 'required|date',
        'estado' => 'required|string',
        // ❌ quitar numero_orden de aquí
        ]);

         $lastOrden = Orden::latest('id')->first();
    $nextId = $lastOrden ? $lastOrden->id + 1 : 1;
    $validated['numero_orden'] = 'ORD-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

    // Guardar
    Orden::create($validated);

    return redirect()->route('ordenes.index')
        ->with('success', 'Orden creada exitosamente.');
    }

    public function show(Orden $orden)
    {
        return view('ordenes.show', compact('orden'));
    }

    public function edit(Orden $orden)
{
    // Traemos todos los vehículos que pertenecen al cliente de esta orden
    $vehiculosCliente = Vehiculo::where('cliente_id', $orden->cliente_id)->get();

    // También puedes seguir mandando lo que ya tenías
    $clientes = Cliente::all();
    $vehiculos = Vehiculo::all();

    return view('ordenes.edit', compact('orden', 'clientes', 'vehiculos', 'vehiculosCliente'));
}

    public function update(Request $request, Orden $orden)
{
    $request->validate([
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'problema_reportado' => 'required|string',
        'fecha_apertura' => 'required|date',
        'estado' => 'required|string',
    ]);

    $orden->update([
        'vehiculo_id' => $request->vehiculo_id,
        'problema_reportado' => $request->problema_reportado,
        'fecha_apertura' => $request->fecha_apertura,
        'estado' => $request->estado,
    ]);

    return redirect()->route('ordenes.show', $orden)->with('success', 'Orden actualizada correctamente.');
}

    public function destroy($id)
{
    $orden = Orden::findOrFail($id);
    $orden->delete();

    return redirect()->route('ordenes.index')
        ->with('success', 'La orden fue eliminada correctamente.');
}
}
