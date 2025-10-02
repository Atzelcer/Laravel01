<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $curso->nombre }}</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('cursos.edit', $curso) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                Editar
                            </a>
                            <a href="{{ route('cursos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                Volver
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Información General</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">ID:</span>
                                        <span class="text-gray-800">{{ $curso->id }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Nombre:</span>
                                        <span class="text-gray-800">{{ $curso->nombre }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Precio:</span>
                                        <span class="text-green-600 font-bold">${{ number_format($curso->precio, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Fechas</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">Inicio:</span>
                                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('d/m/Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Fin:</span>
                                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($curso->fecha_fin)->format('d/m/Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Duración:</span>
                                        <span class="text-gray-800">
                                            {{ \Carbon\Carbon::parse($curso->fecha_inicio)->diffInDays(\Carbon\Carbon::parse($curso->fecha_fin)) + 1 }} días
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Descripción</h3>
                                <p class="text-gray-800 leading-relaxed">{{ $curso->descripcion }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Estadísticas</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">Inscritos:</span>
                                        <span class="text-blue-600 font-bold">{{ $curso->inscripciones->count() }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Ingresos generados:</span>
                                        <span class="text-green-600 font-bold">${{ number_format($curso->inscripciones->count() * $curso->precio, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Inscritos -->
                    @if($curso->inscripciones->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Personas Inscritas</h3>
                        <div class="bg-gray-50 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inscripción</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($curso->inscripciones as $inscripcion)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $inscripcion->persona->nombre }} {{ $inscripcion->persona->apellido }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $inscripcion->persona->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($inscripcion->fecha_inscripcion)->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <p class="text-yellow-800">No hay personas inscritas en este curso aún.</p>
                    </div>
                    @endif

                    <!-- Acciones -->
                    <div class="mt-8 flex justify-between items-center pt-6 border-t border-gray-200">
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de que quieres eliminar este curso? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                Eliminar Curso
                            </button>
                        </form>
                        
                        <div class="text-sm text-gray-500">
                            Creado: {{ $curso->created_at->format('d/m/Y H:i') }} | 
                            Actualizado: {{ $curso->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>