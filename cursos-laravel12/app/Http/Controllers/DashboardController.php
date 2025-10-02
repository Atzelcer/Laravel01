<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Persona;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCursos = Curso::count();
        $totalPersonas = Persona::count();
        $totalInscripciones = Inscripcion::count();
        
        $cursosPopulares = Curso::withCount('inscripciones')
            ->orderBy('inscripciones_count', 'desc')
            ->take(5)
            ->get();
            
        $inscripcionesRecientes = Inscripcion::with(['curso', 'persona'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $ingresosTotales = Inscripcion::sum('monto');

        return view('dashboard', compact(
            'totalCursos',
            'totalPersonas', 
            'totalInscripciones',
            'cursosPopulares',
            'inscripcionesRecientes',
            'ingresosTotales'
        ));
    }
}
