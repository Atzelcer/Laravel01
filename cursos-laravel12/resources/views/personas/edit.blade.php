<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Persona') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Editar Persona</h1>
                        <a href="{{ route('personas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Volver
                        </a>
                    </div>

        <form action="{{ route('personas.update', $persona) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="numero_documento" class="block text-sm font-medium text-gray-700 mb-2">Número de Documento</label>
                <input type="text" id="numero_documento" name="numero_documento" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('numero_documento', $persona->numero_documento) }}" required>
                @error('numero_documento')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nombres" class="block text-sm font-medium text-gray-700 mb-2">Nombres</label>
                <input type="text" id="nombres" name="nombres" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('nombres', $persona->nombres) }}" required>
                @error('nombres')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-2">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('apellidos', $persona->apellidos) }}" required>
                @error('apellidos')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sexo" class="block text-sm font-medium text-gray-700 mb-2">Sexo</label>
                <select id="sexo" name="sexo" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Seleccionar...</option>
                    <option value="M" {{ old('sexo', $persona->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('sexo', $persona->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                </select>
                @error('sexo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('fecha_nacimiento', $persona->fecha_nacimiento) }}" required>
                @error('fecha_nacimiento')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="celular" class="block text-sm font-medium text-gray-700 mb-2">Celular (Opcional)</label>
                <input type="text" id="celular" name="celular" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('celular', $persona->celular) }}">
                @error('celular')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Actualizar Persona
                </button>
                <a href="{{ route('personas.show', $persona) }}" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-center">
                    Ver Persona
                </a>
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>