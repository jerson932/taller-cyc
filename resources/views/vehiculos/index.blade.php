@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Lista de Vehículos</h1>
    <a href="{{ route('vehiculos.create') }}" class="btn btn-success mb-3">Nuevo Vehículo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Linea</th>
                <th>Año</th>
                <th>Color</th>
                <th>Cliente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
            <tr>
                <td>{{ $vehiculo->id }}</td>
                <td>{{ $vehiculo->marca->nombre }}</td>
                <td>{{ $vehiculo->modelo->nombre }}</td>
                <td>{{ $vehiculo->anio }}</td>
                <td>{{ $vehiculo->color }}</td>
                <td>{{ $vehiculo->cliente?->nombre }}</td>
                <td>
                    <a href="{{ route('vehiculos.show', $vehiculo) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este vehículo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

   {{ $vehiculos->links('pagination::bootstrap-5') }}
</div>
@endsection
