@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la Orden {{ $orden->numero_orden }}</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $orden->cliente->nombre ?? 'N/A' }}</p>
            <p><strong>Vehículo:</strong>
                {{ $orden->vehiculo->marca->nombre ?? '' }}
                {{ $orden->vehiculo->modelo->nombre ?? '' }}
            </p>
            <p><strong>Problema Reportado:</strong> {{ $orden->problema_reportado }}</p>
            <p><strong>Fecha de Apertura:</strong> {{ $orden->fecha_apertura }}</p>
            <p><strong>Estado:</strong> {{ $orden->estado }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Volver al listado</a>
        <a href="{{ route('ordenes.edit', $orden->id) }}" class="btn btn-warning">Editar</a>

        {{-- Botón de eliminar --}}
        <form action="{{ route('ordenes.destroy', $orden->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('⚠️ ¿Seguro que deseas eliminar esta orden?')">
                Eliminar
            </button>
        </form>
    </div>
</div>
@endsection
