<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Inscripción') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Editar Inscripción</h1>
                        <a href="{{ route('inscripciones.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Volver
                        </a>
                    </div>

        <form action="{{ route('inscripciones.update', $inscripcion) }}" method="POST" id="inscripcionForm">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="curso_id" class="block text-sm font-medium text-gray-700 mb-2">Curso</label>
                <select id="curso_id" name="curso_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required onchange="actualizarPrecio()">
                    <option value="">Seleccionar curso...</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" 
                                data-precio="{{ $curso->precio }}"
                                {{ old('curso_id', $inscripcion->curso_id) == $curso->id ? 'selected' : '' }}>
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
                        <option value="{{ $persona->id }}" {{ old('persona_id', $inscripcion->persona_id) == $persona->id ? 'selected' : '' }}>
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
                       value="{{ old('fecha', $inscripcion->fecha) }}" required>
                @error('fecha')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="monto" class="block text-sm font-medium text-gray-700 mb-2">Monto</label>
                <input type="number" step="0.01" id="monto" name="monto" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('monto', $inscripcion->monto) }}" required>
                @error('monto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Puedes modificar el monto manualmente si es necesario.</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Actualizar Inscripción
                </button>
                <a href="{{ route('inscripciones.show', $inscripcion) }}" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-center">
                    Ver Inscripción
                </a>
            </div>
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
                // Solo actualizar si el monto está vacío o es igual al precio del curso anterior
                if (!montoInput.value || confirm('¿Quieres actualizar el monto al precio del nuevo curso?')) {
                    montoInput.value = precio;
                }
            }
        }
    </script>
</x-app-layout>