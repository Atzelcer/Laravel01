<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'fecha_inicio'=>'required|date',
            'fecha_fin'=>'required|date',
            'precio'=>'required|numeric'
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'fecha_inicio'=>'required|date',
            'fecha_fin'=>'required|date',
            'precio'=>'required|numeric'
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
