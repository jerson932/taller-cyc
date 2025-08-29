@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Vehículo</h1>

    <form action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Marca --}}
        <div class="mb-3">
            <label class="form-label">Marca *</label>
            <select name="marca_id" id="marca_id" class="form-control" required>
                <option value="">Seleccione una marca</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}" {{ $vehiculo->marca_id == $marca->id ? 'selected' : '' }}>
                        {{ $marca->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Modelo (depende de marca) --}}
        <div class="mb-3">
            <label class="form-label">Linea *</label>
            <select name="modelo_id" id="modelo_id" class="form-control" required>
                <option value="">Seleccione un Linea</option>
            </select>
        </div>

        {{-- Año --}}
        <div class="mb-3">
            <label class="form-label">Año *</label>
            <input type="number" name="anio" class="form-control" value="{{ $vehiculo->anio }}" required>
        </div>

        {{-- Color --}}
        <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control" value="{{ $vehiculo->color }}">
        </div>

        {{-- Cliente --}}
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-control">
                <option value="">Sin asignar</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $vehiculo->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha de ingreso --}}
        <div class="mb-3">
            <label class="form-label">Fecha de ingreso *</label>
            <input type="date" name="fecha_ingreso" class="form-control"
                   value="{{ optional($vehiculo->fecha_ingreso)->format('Y-m-d') }}" required>
        </div>

        {{-- Detalle --}}
        <div class="mb-3">
    <label for="detalle" class="form-label">Detalle del vehículo</label>
    <textarea name="detalle" id="detalle" class="form-control">{{ old('detalle', $vehiculo->detalle ?? '') }}</textarea>
</div>

        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const marcaSelect = document.getElementById('marca_id');
    const modeloSelect = document.getElementById('modelo_id');
    const modeloSeleccionado = "{{ $vehiculo->modelo_id ?? '' }}"; // siempre string vacío si no hay modelo

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

    // Al cargar la página, llena los modelos de la marca actual y selecciona el del vehículo
    cargarModelos(marcaSelect.value, modeloSeleccionado);

    // Si cambia la marca, recarga modelos
    marcaSelect.addEventListener('change', (e) => {
        cargarModelos(e.target.value);
    });
});
</script>
@endpush
