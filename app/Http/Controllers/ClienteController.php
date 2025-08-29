<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Vehiculo;


class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
          $clientes = Cliente::paginate(10); // 👈 importante
    return view('clientes.index', compact('clientes'));
    }

    // Formulario para crear cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar cliente
    public function store(Request $request)
{
    try {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    } catch (\Exception $e) {
        return redirect()->route('clientes.index')->with('error', 'Ocurrió un error al crear el cliente.');
    }
}
public function vehiculos($id)
{
    $vehiculos = \App\Models\Vehiculo::with(['marca','modelo'])
        ->where('cliente_id', $id)
        ->get();

    return response()->json($vehiculos);
}

    // Mostrar un cliente
    public function show(Cliente $cliente)
    {
          $cliente->load(['vehiculos.marca', 'vehiculos.modelo', 'ordenes']);

    return view('clientes.show', compact('cliente'));
    }

    // Formulario para editar cliente
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
