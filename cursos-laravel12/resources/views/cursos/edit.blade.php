<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Editar Curso</h1>
                        <a href="{{ route('cursos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Volver
                        </a>
                    </div>

        <form action="{{ route('cursos.update', $curso) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                <input type="text" id="nombre" name="nombre" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('nombre', $curso->nombre) }}" required>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('fecha_inicio', $curso->fecha_inicio) }}" required>
                @error('fecha_inicio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('fecha_fin', $curso->fecha_fin) }}" required>
                @error('fecha_fin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('precio', $curso->precio) }}" required>
                @error('precio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Actualizar Curso
                </button>
                <a href="{{ route('cursos.show', $curso) }}" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-center">
                    Ver Curso
                </a>
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>