<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de la Inscripción') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">Inscripción #{{ $inscripcion->id }}</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('inscripciones.edit', $inscripcion) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                Editar
                            </a>
                            <a href="{{ route('inscripciones.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                Volver
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Información de la Inscripción</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-gray-600">ID:</span>
                                        <span class="text-gray-800">{{ $inscripcion->id }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Fecha de Inscripción:</span>
                                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($inscripcion->fecha)->format('d/m/Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Monto Pagado:</span>
                                        <span class="text-green-600 font-bold">${{ number_format($inscripcion->monto, 2) }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Estado del Pago:</span>
                                        @if($inscripcion->monto == $inscripcion->curso->precio)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Pago Completo
                                            </span>
                                        @elseif($inscripcion->monto < $inscripcion->curso->precio)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pago Parcial
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Sobrepago
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <h3 class="text-lg font-semibold text-blue-700 mb-2">Información del Curso</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-blue-600">Curso:</span>
                                        <a href="{{ route('cursos.show', $inscripcion->curso) }}" class="text-blue-800 hover:text-blue-900 font-medium">
                                            {{ $inscripcion->curso->nombre }}
                                        </a>
                                    </div>
                                    <div>
                                        <span class="font-medium text-blue-600">Precio del Curso:</span>
                                        <span class="text-blue-800 font-bold">${{ number_format($inscripcion->curso->precio, 2) }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-blue-600">Fecha de Inicio:</span>
                                        <span class="text-blue-800">{{ \Carbon\Carbon::parse($inscripcion->curso->fecha_inicio)->format('d/m/Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-blue-600">Fecha de Fin:</span>
                                        <span class="text-blue-800">{{ \Carbon\Carbon::parse($inscripcion->curso->fecha_fin)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                <h3 class="text-lg font-semibold text-purple-700 mb-2">Información del Estudiante</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="font-medium text-purple-600">Nombre Completo:</span>
                                        <a href="{{ route('personas.show', $inscripcion->persona) }}" class="text-purple-800 hover:text-purple-900 font-medium">
                                            {{ $inscripcion->persona->nombres }} {{ $inscripcion->persona->apellidos }}
                                        </a>
                                    </div>
                                    <div>
                                        <span class="font-medium text-purple-600">Documento:</span>
                                        <span class="text-purple-800">{{ $inscripcion->persona->numero_documento }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-purple-600">Sexo:</span>
                                        <span class="text-purple-800">{{ $inscripcion->persona->sexo == 'M' ? 'Masculino' : 'Femenino' }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-purple-600">Celular:</span>
                                        <span class="text-purple-800">{{ $inscripcion->persona->celular ?? 'No registrado' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Estado del Curso</h3>
                                <div class="space-y-2">
                                    @php
                                        $ahora = \Carbon\Carbon::now();
                                        $inicio = \Carbon\Carbon::parse($inscripcion->curso->fecha_inicio);
                                        $fin = \Carbon\Carbon::parse($inscripcion->curso->fecha_fin);
                                        $diasParaInicio = $ahora->diffInDays($inicio, false);
                                        $diasParaFin = $ahora->diffInDays($fin, false);
                                    @endphp
                                    
                                    @if($ahora < $inicio)
                                        <div class="text-center p-3 bg-yellow-100 rounded-lg">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-200 text-yellow-800">
                                                Próximo a Iniciar
                                            </span>
                                            <p class="text-yellow-700 text-sm mt-2">
                                                Faltan {{ abs($diasParaInicio) }} días para que inicie el curso
                                            </p>
                                        </div>
                                    @elseif($ahora >= $inicio && $ahora <= $fin)
                                        <div class="text-center p-3 bg-green-100 rounded-lg">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-200 text-green-800">
                                                En Curso
                                            </span>
                                            <p class="text-green-700 text-sm mt-2">
                                                Faltan {{ abs($diasParaFin) }} días para que termine el curso
                                            </p>
                                        </div>
                                    @else
                                        <div class="text-center p-3 bg-gray-100 rounded-lg">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-800">
                                                Finalizado
                                            </span>
                                            <p class="text-gray-700 text-sm mt-2">
                                                El curso terminó hace {{ abs($diasParaFin) }} días
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($inscripcion->monto != $inscripcion->curso->precio)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-yellow-700 mb-2">Diferencia de Pago</h3>
                                @php
                                    $diferencia = $inscripcion->curso->precio - $inscripcion->monto;
                                @endphp
                                @if($diferencia > 0)
                                    <p class="text-yellow-800">
                                        <span class="font-medium">Saldo pendiente:</span> 
                                        <span class="font-bold text-red-600">${{ number_format($diferencia, 2) }}</span>
                                    </p>
                                @else
                                    <p class="text-yellow-800">
                                        <span class="font-medium">Sobrepago:</span> 
                                        <span class="font-bold text-blue-600">${{ number_format(abs($diferencia), 2) }}</span>
                                    </p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Descripción del Curso -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Descripción del Curso</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-800 leading-relaxed">{{ $inscripcion->curso->descripcion }}</p>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="mt-8 flex justify-between items-center pt-6 border-t border-gray-200">
                        <form action="{{ route('inscripciones.destroy', $inscripcion) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta inscripción? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                Eliminar Inscripción
                            </button>
                        </form>
                        
                        <div class="text-sm text-gray-500">
                            Registrada: {{ $inscripcion->created_at->format('d/m/Y H:i') }} | 
                            Actualizada: {{ $inscripcion->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>