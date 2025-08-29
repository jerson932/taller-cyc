@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Vehículo</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $vehiculo->id }}</p>
            <p><strong>Marca:</strong> {{ $vehiculo->marca->nombre }}</p>
            <p><strong>Linea:</strong> {{ $vehiculo->modelo->nombre }}</p>
            <p><strong>Año:</strong> {{ $vehiculo->anio }}</p>
            <p><strong>Color:</strong> {{ $vehiculo->color }}</p>
            <p><strong>Cliente:</strong> {{ $vehiculo->cliente?->nombre ?? 'Sin cliente' }}</p>
            <p><strong>Fecha de ingreso:</strong> {{ \Carbon\Carbon::parse($vehiculo->fecha_ingreso)->format('d/m/Y') }}</p>
            <p><strong>Detalle del vehículo:</strong> {{ $vehiculo->detalle ?? 'Sin detalles' }}</p>
        </div>
    </div>

    <a href="{{ route('vehiculos.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
