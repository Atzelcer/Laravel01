<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Curso;
use App\Models\Persona;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inscripciones = Inscripcion::with(['curso', 'persona'])->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Curso::all();
        $personas = Persona::all();
        return view('inscripciones.create', compact('cursos', 'personas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id'=>'required|exists:cursos,id',
            'persona_id'=>'required|exists:personas,id',
            'fecha'=>'required|date',
            'monto'=>'required|numeric'
        ]);

        Inscripcion::create($request->all());

        return redirect()->route('inscripciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inscripcion $inscripcion)
    {
        return view('inscripciones.show', compact('inscripcion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inscripcion $inscripcion)
    {
        $cursos = Curso::all();
        $personas = Persona::all();
        return view('inscripciones.edit', compact('inscripcion', 'cursos', 'personas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'curso_id'=>'required|exists:cursos,id',
            'persona_id'=>'required|exists:personas,id',
            'fecha'=>'required|date',
            'monto'=>'required|numeric'
        ]);

        $inscripcion->update($request->all());

        return redirect()->route('inscripciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('inscripciones.index');
    }
}
