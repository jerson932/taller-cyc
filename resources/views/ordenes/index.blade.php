@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Órdenes</h1>

    <a href="{{ route('ordenes.create') }}" class="btn btn-primary mb-3">Nueva Orden</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th># Orden</th>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Problema Reportado</th>
                <th>Fecha Apertura</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ordenes as $orden)
                <tr>
                    <td>{{ $orden->numero_orden }}</td>
                    <td>{{ $orden->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $orden->vehiculo->marca->nombre ?? '' }} {{ $orden->vehiculo->modelo->nombre ?? '' }}</td>
                    <td>{{ $orden->problema_reportado }}</td>
                    <td>{{ $orden->fecha_apertura }}</td>
                    <td>{{ $orden->estado }}</td>
                    <td>
                        <a href="{{ route('ordenes.show', $orden) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('ordenes.edit', $orden) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('ordenes.destroy', $orden) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta orden?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay órdenes registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
{{ $ordenes->links('pagination::bootstrap-5') }}</div>
@endsection
