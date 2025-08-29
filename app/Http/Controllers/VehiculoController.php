<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Mostrar listado de vehículos
     */
    public function index()
    {
        $vehiculos = Vehiculo::with(['marca', 'modelo', 'cliente'])->paginate(10);
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $marcas   = Marca::all();
        $clientes = Cliente::all();

        // Modelos ya no los mandamos aquí, se cargarán por AJAX
        return view('vehiculos.create', compact('marcas', 'clientes'));
    }

    /**
     * Guardar un nuevo vehículo
     */
    public function store(Request $request)
    {
          $request->validate([
        'marca_id'      => 'required|exists:marcas,id',
        'modelo_id'     => 'required|exists:modelos,id',
        'anio'          => 'required|integer|min:1900|max:' . date('Y'),
        'color'         => 'nullable|string|max:50',
        'cliente_id'    => 'nullable|exists:clientes,id',
        'fecha_ingreso' => 'required|date',
        'detalle'       => 'nullable|string',

        ]);

        Vehiculo::create($request->all());

        
    return redirect()->route('vehiculos.index')
        ->with('success', 'Vehículo creado correctamente.');
    }

    /**
     * Mostrar un vehículo
     */
    public function show(Vehiculo $vehiculo)
    {
        return view('vehiculos.show', compact('vehiculo'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Vehiculo $vehiculo)
    {
        $marcas   = Marca::all();
        $clientes = Cliente::all();
        $modelos  = Modelo::where('marca_id', $vehiculo->marca_id)->get();

        return view('vehiculos.edit', compact('vehiculo', 'marcas', 'clientes', 'modelos'));
    }

    /**
     * Actualizar un vehículo
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
        'marca_id'      => 'required|exists:marcas,id',
        'modelo_id'     => 'required|exists:modelos,id',
        'anio'          => 'required|integer|min:1900|max:' . date('Y'),
        'color'         => 'nullable|string|max:50',
        'cliente_id'    => 'nullable|exists:clientes,id',
        'fecha_ingreso' => 'required|date',
        'detalle'       => 'nullable|string',

        ]);

        $vehiculo->update($request->all());

         return redirect()->route('vehiculos.index')
        ->with('success', 'Vehículo actualizado correctamente.');
    }

    /**
     * Eliminar un vehículo
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')
                         ->with('success', 'Vehículo eliminado correctamente.');
    }

    /**
     * Obtener modelos por marca (AJAX)
     */
    public function getModelosPorMarca($marca_id)
    {
        $modelos = Modelo::where('marca_id', $marca_id)->get();
        return response()->json($modelos);
    }
}
