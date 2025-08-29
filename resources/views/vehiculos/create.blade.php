@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Vehículo</h1>

    <form action="{{ route('vehiculos.store') }}" method="POST">
        @csrf
        {{-- Marca --}}
        <div class="mb-3">
            <label class="form-label">Marca *</label>
            <select name="marca_id" id="marca_id" class="form-control" required>
                <option value="">Seleccione una marca</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Modelo (se llena por marca) --}}
        <div class="mb-3">
            <label class="form-label">Linea *</label>
            <select name="modelo_id" id="modelo_id" class="form-control" required>
                <option value="">Seleccione un Linea</option>
            </select>
        </div>

        {{-- Año --}}
        <div class="mb-3">
            <label class="form-label">Año *</label>
            <input type="number" name="anio" class="form-control" required>
        </div>

        {{-- Color --}}
        <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control">
        </div>

        {{-- Cliente --}}
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control">
                <option value="">Sin asignar</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="mb-3">
            <label class="form-label">Vehículo del cliente</label>
            <select id="vehiculo_id" class="form-control">
                <option value="">Seleccione un cliente primero</option>
            </select>
        </div>Vehículos por cliente (dinámico) --}}
        

        {{-- Fecha de ingreso --}}
        <div class="mb-3">
            <label class="form-label">Fecha de ingreso *</label>
            <input type="date" name="fecha_ingreso" class="form-control" required>
        </div>

        {{-- Detalle --}}
    <div class="mb-3">
    <label for="detalle" class="form-label">Detalle del vehículo</label>
    <textarea name="detalle" id="detalle" class="form-control">{{ old('detalle', $vehiculo->detalle ?? '') }}</textarea>
</div>

        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const marcaSelect = document.getElementById('marca_id');
    const modeloSelect = document.getElementById('modelo_id');
    const clienteSelect = document.getElementById('cliente_id');
    const vehiculoSelect = document.getElementById('vehiculo_id');

    // Cargar modelos por marca
    async function cargarModelos(marcaId, seleccionado = null) {
        modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
        if (!marcaId) return;

        try {
            const url = "{{ route('modelos.byMarca', ':id') }}".replace(':id', marcaId);
            const resp = await fetch(url);
            const data = await resp.json();

            data.forEach(m => {
                const opt = document.createElement('option');
                opt.value = m.id;
                opt.textContent = m.nombre;
                if (seleccionado && Number(seleccionado) === Number(m.id)) opt.selected = true;
                modeloSelect.appendChild(opt);
            });
        } catch (e) {
            console.error('Error cargando modelos:', e);
            modeloSelect.innerHTML = '<option value="">Error al cargar</option>';
        }
    }

    // Cargar vehículos por cliente
    async function cargarVehiculos(clienteId, seleccionado = null) {
        vehiculoSelect.innerHTML = '<option value="">Seleccione un vehículo</option>';
        if (!clienteId) return;

        try {
            const url = "{{ route('clientes.vehiculos', ':id') }}".replace(':id', clienteId);
            const resp = await fetch(url);
            const data = await resp.json();

            data.forEach(v => {
                const opt = document.createElement('option');
                opt.value = v.id;
                opt.textContent = `${v.marca.nombre} ${v.modelo.nombre} (${v.anio})`;
                if (seleccionado && Number(seleccionado) === Number(v.id)) opt.selected = true;
                vehiculoSelect.appendChild(opt);
            });
        } catch (e) {
            console.error('Error cargando vehículos:', e);
            vehiculoSelect.innerHTML = '<option value="">Error al cargar</option>';
        }
    }

    marcaSelect.addEventListener('change', (e) => {
        cargarModelos(e.target.value);
    });

    clienteSelect.addEventListener('change', (e) => {
        cargarVehiculos(e.target.value);
    });
});
</script>
@endpush
