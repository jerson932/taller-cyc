@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Orden {{ $orden->numero_orden }}</h1>

    <form action="{{ route('ordenes.update', $orden->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Número de Orden (solo lectura) --}}
        <div class="mb-3">
            <label class="form-label">Número de Orden</label>
            <input type="text" class="form-control" value="{{ $orden->numero_orden }}" disabled>
        </div>

        {{-- Cliente (solo lectura) --}}
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <input type="text" class="form-control" value="{{ $orden->cliente->nombre }}" disabled>
            <input type="hidden" name="cliente_id" value="{{ $orden->cliente_id }}">
        </div>

        {{-- Vehículo --}}
        <div class="mb-3">
            <label class="form-label">Vehículo *</label>
            <select name="vehiculo_id" id="vehiculo_id" class="form-control" required>
                <option value="">-- Selecciona un vehículo --</option>
                @foreach($vehiculosCliente as $vehiculo)
                    <option value="{{ $vehiculo->id }}"
                        {{ $orden->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>
                        {{ $vehiculo->marca->nombre ?? '' }} {{ $vehiculo->modelo->nombre ?? '' }} ({{ $vehiculo->anio }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Problema Reportado --}}
        <div class="mb-3">
            <label class="form-label">Problema Reportado *</label>
            <textarea name="problema_reportado" class="form-control" rows="3" required>{{ old('problema_reportado', $orden->problema_reportado) }}</textarea>
        </div>

        {{-- Fecha de Apertura --}}
        <div class="mb-3">
            <label class="form-label">Fecha Apertura</label>
            <input type="date" name="fecha_apertura" class="form-control"
                   value="{{ old('fecha_apertura', $orden->fecha_apertura) }}">
        </div>

        {{-- Estado --}}
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-control">
                <option value="Pendiente" {{ $orden->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="En Proceso" {{ $orden->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="Completada" {{ $orden->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Orden</button>
        <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
