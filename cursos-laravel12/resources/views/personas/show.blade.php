<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de la Persona') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $persona->nombres }} {{ $persona->apellidos }}</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('personas.edit', $persona) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                Editar
                            </a>
                            <a href="{{ route('personas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                Volver
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Información Personal</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">ID:</span>
                                        <span class="text-gray-800">{{ $persona->id }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Documento:</span>
                                        <span class="text-gray-800">{{ $persona->numero_documento }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Nombres:</span>
                                        <span class="text-gray-800">{{ $persona->nombres }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Apellidos:</span>
                                        <span class="text-gray-800">{{ $persona->apellidos }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Sexo:</span>
                                        <span class="text-gray-800">
                                            @if($persona->sexo == 'M')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Masculino
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                                    Femenino
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Información de Contacto</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">Celular:</span>
                                        <span class="text-gray-800">{{ $persona->celular ?? 'No registrado' }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Fecha de Nacimiento:</span>
                                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Edad:</span>
                                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->age }} años</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Estadísticas de Inscripciones</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">Cursos inscritos:</span>
                                        <span class="text-blue-600 font-bold">{{ $persona->inscripciones->count() }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Total invertido:</span>
                                        <span class="text-green-600 font-bold">${{ number_format($persona->inscripciones->sum(function($inscripcion) { return $inscripcion->curso->precio; }), 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($persona->inscripciones->count() > 0)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Última Inscripción</h3>
                                @php
                                    $ultimaInscripcion = $persona->inscripciones->sortByDesc('fecha_inscripcion')->first();
                                @endphp
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">Curso:</span>
                                        <span class="text-gray-800">{{ $ultimaInscripcion->curso->nombre }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Fecha:</span>
                                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($ultimaInscripcion->fecha_inscripcion)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Lista de Cursos Inscritos -->
                    @if($persona->inscripciones->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Cursos Inscritos</h3>
                        <div class="bg-gray-50 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inscripción</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($persona->inscripciones->sortByDesc('fecha_inscripcion') as $inscripcion)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="{{ route('cursos.show', $inscripcion->curso) }}" class="text-blue-600 hover:text-blue-900">
                                                {{ $inscripcion->curso->nombre }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">
                                            ${{ number_format($inscripcion->curso->precio, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($inscripcion->fecha_inscripcion)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @php
                                                $ahora = \Carbon\Carbon::now();
                                                $inicio = \Carbon\Carbon::parse($inscripcion->curso->fecha_inicio);
                                                $fin = \Carbon\Carbon::parse($inscripcion->curso->fecha_fin);
                                            @endphp
                                            @if($ahora < $inicio)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Próximo
                                                </span>
                                            @elseif($ahora >= $inicio && $ahora <= $fin)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    En Curso
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Finalizado
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <p class="text-yellow-800">Esta persona no está inscrita en ningún curso aún.</p>
                    </div>
                    @endif

                    <!-- Acciones -->
                    <div class="mt-8 flex justify-between items-center pt-6 border-t border-gray-200">
                        <form action="{{ route('personas.destroy', $persona) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta persona? Esta acción no se puede deshacer y eliminará todas sus inscripciones.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                Eliminar Persona
                            </button>
                        </form>
                        
                        <div class="text-sm text-gray-500">
                            Registrado: {{ $persona->created_at->format('d/m/Y H:i') }} | 
                            Actualizado: {{ $persona->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>