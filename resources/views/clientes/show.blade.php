@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Cliente</h2>

    <!-- Datos del cliente -->
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $cliente->id }}</p>
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono ?? '—' }}</p>
            <p><strong>Email:</strong> {{ $cliente->email ?? '—' }}</p>
        </div>
    </div>

    <!-- 🚗 Vehículos del cliente -->
    <h4>Vehículos Asignados</h4>

    @if($cliente->vehiculos->count() > 0)
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cliente->vehiculos as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->id }}</td>
                        <td>{{ $vehiculo->marca->nombre ?? '—' }}</td>
                        <td>{{ $vehiculo->modelo->nombre ?? '—' }}</td>
                        <td>{{ $vehiculo->placa }}</td>
                        <td>
                            <a href="{{ route('vehiculos.show', $vehiculo) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Este cliente no tiene vehículos registrados.</p>
    @endif

    <!-- 📋 Órdenes del cliente -->
    <h4 class="mt-4">Órdenes de Servicio</h4>

    @if($cliente->ordenes->count() > 0)
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th># Orden</th>
                    <th>Detalle</th>
                    <th>Fecha Apertura</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cliente->ordenes as $orden)
                    <tr>
                        <td>{{ $orden->numero_orden }}</td>
                        <td>{{ Str::limit($orden->problema_reportado, 40) }}</td>
                        <td>{{ $orden->fecha_apertura }}</td>
                        <td>{{ $orden->estado }}</td>
                        <td>
                            <a href="{{ route('ordenes.show', $orden) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('ordenes.edit', $orden) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('ordenes.destroy', $orden) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta orden?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Este cliente no tiene órdenes registradas.</p>
    @endif

    <!-- Acciones del cliente -->
    <div class="mt-4">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">Editar</a>

        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este cliente?')">
                Eliminar
            </button>
        </form>
    </div>
</div>
@endsection
