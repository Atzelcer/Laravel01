<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Inscripción') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Crear Inscripción</h1>
                        <a href="{{ route('inscripciones.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Volver
                        </a>
                    </div>

        <form action="{{ route('inscripciones.store') }}" method="POST" id="inscripcionForm">
            @csrf
            
            <div class="mb-4">
                <label for="curso_id" class="block text-sm font-medium text-gray-700 mb-2">Curso</label>
                <select id="curso_id" name="curso_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required onchange="actualizarPrecio()">
                    <option value="">Seleccionar curso...</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" 
                                data-precio="{{ $curso->precio }}"
                                {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nombre }} - ${{ number_format($curso->precio, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('curso_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="persona_id" class="block text-sm font-medium text-gray-700 mb-2">Persona</label>
                <select id="persona_id" name="persona_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Seleccionar persona...</option>
                    @foreach($personas as $persona)
                        <option value="{{ $persona->id }}" {{ old('persona_id') == $persona->id ? 'selected' : '' }}>
                            {{ $persona->nombres }} {{ $persona->apellidos }} - {{ $persona->numero_documento }}
                        </option>
                    @endforeach
                </select>
                @error('persona_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inscripción</label>
                <input type="date" id="fecha" name="fecha" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('fecha', date('Y-m-d')) }}" required>
                @error('fecha')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="monto" class="block text-sm font-medium text-gray-700 mb-2">Monto</label>
                <input type="number" step="0.01" id="monto" name="monto" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('monto') }}" required readonly>
                @error('monto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">El monto se establece automáticamente según el precio del curso.</p>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Crear Inscripción
            </button>
        </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function actualizarPrecio() {
            const cursoSelect = document.getElementById('curso_id');
            const montoInput = document.getElementById('monto');
            const selectedOption = cursoSelect.options[cursoSelect.selectedIndex];
            
            if (selectedOption.value) {
                const precio = selectedOption.getAttribute('data-precio');
                montoInput.value = precio;
            } else {
                montoInput.value = '';
            }
        }

        // Establecer precio inicial si hay un curso preseleccionado
        document.addEventListener('DOMContentLoaded', function() {
            actualizarPrecio();
        });
    </script>
</x-app-layout>