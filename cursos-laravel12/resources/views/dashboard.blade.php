<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Sistema de Cursos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-blue-500 text-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium">Total Cursos</h3>
                            <p class="text-2xl font-bold">{{ $totalCursos }}</p>
                        </div>
                        <div class="text-blue-200">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-green-500 text-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium">Total Personas</h3>
                            <p class="text-2xl font-bold">{{ $totalPersonas }}</p>
                        </div>
                        <div class="text-green-200">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-500 text-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium">Total Inscripciones</h3>
                            <p class="text-2xl font-bold">{{ $totalInscripciones }}</p>
                        </div>
                        <div class="text-purple-200">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-500 text-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium">Ingresos Totales</h3>
                            <p class="text-2xl font-bold">${{ number_format($ingresosTotales, 2) }}</p>
                        </div>
                        <div class="text-yellow-200">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Cursos más populares -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Cursos Más Populares</h3>
                        <div class="space-y-3">
                            @foreach($cursosPopulares as $curso)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $curso->nombre }}</p>
                                        <p class="text-sm text-gray-600">${{ number_format($curso->precio, 2) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $curso->inscripciones_count }} inscripciones
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Inscripciones recientes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Inscripciones Recientes</h3>
                        <div class="space-y-3">
                            @foreach($inscripcionesRecientes as $inscripcion)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $inscripcion->persona->nombres }} {{ $inscripcion->persona->apellidos }}</p>
                                        <p class="text-sm text-gray-600">{{ $inscripcion->curso->nombre }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">${{ number_format($inscripcion->monto, 2) }}</p>
                                        <p class="text-xs text-gray-500">{{ $inscripcion->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enlaces rápidos -->
            @if(auth()->user()->role === 'admin')
            <div class="mt-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones Rápidas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('cursos.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 justify-center">
                                Crear Nuevo Curso
                            </a>
                            <a href="{{ route('personas.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 justify-center">
                                Registrar Persona
                            </a>
                            <a href="{{ route('inscripciones.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150 justify-center">
                                Nueva Inscripción
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
