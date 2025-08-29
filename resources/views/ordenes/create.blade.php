@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Orden de Servicio</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ordenes.store') }}" method="POST">
        @csrf

                {{-- Número de Orden<div class="mb-3">
            <label for="numero_orden" class="form-label">Número de Orden *</label>
            <input type="text" name="numero_orden" id="numero_orden" class="form-control" 
                value="{{ old('numero_orden') }}" required>
        </div> --}}
        

        {{-- Cliente --}}
        <div class="mb-3">
            <label class="form-label">Cliente *</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">-- Selecciona un cliente --</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Vehículo --}}
        <div class="mb-3">
            <label class="form-label">Vehículo *</label>
            <select name="vehiculo_id" id="vehiculo_id" class="form-control" required>
                <option value="">-- Selecciona un vehículo --</option>
            </select>
        </div>

        {{-- Problema Reportado --}}
        <div class="mb-3">
            <label for="problema_reportado" class="form-label">Problema Reportado *</label>
            <textarea name="problema_reportado" id="problema_reportado" class="form-control" rows="3" required></textarea>
        </div>

        {{-- Fecha Apertura --}}
        <div class="mb-3">
            <label class="form-label">Fecha Apertura *</label>
            <input type="date" name="fecha_apertura" value="{{ now()->format('Y-m-d') }}" class="form-control" required>
        </div>

        {{-- Estado --}}
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control">
                <option value="Abierta" selected>Abierta</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Finalizada">Finalizada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Orden</button>
        <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const clienteSelect = document.getElementById('cliente_id');
    const vehiculoSelect = document.getElementById('vehiculo_id');

    clienteSelect.addEventListener('change', async function() {
        const clienteId = this.value;
        vehiculoSelect.innerHTML = '<option value="">-- Selecciona un vehículo --</option>';

        if (!clienteId) return;

        try {
            const url = "{{ route('clientes.vehiculos', ':id') }}".replace(':id', clienteId);
            const resp = await fetch(url);
            const data = await resp.json();

            data.forEach(v => {
                const opt = document.createElement('option');
                opt.value = v.id;
                opt.textContent = `${v.marca.nombre} ${v.modelo.nombre} (${v.anio})`;
                vehiculoSelect.appendChild(opt);
            });
        } catch (err) {
            console.error("Error cargando vehículos:", err);
        }
    });
});
</script>
@endpush
