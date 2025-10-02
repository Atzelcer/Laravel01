<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_documento'=>'required|unique:personas',
            'nombres'=>'required',
            'apellidos'=>'required',
            'sexo'=>'required|in:M,F',
            'fecha_nacimiento'=>'required|date',
            'celular'=>'nullable'
        ]);

        Persona::create($request->all());

        return redirect()->route('personas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        return view('personas.show', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'numero_documento'=>'required|unique:personas,numero_documento,'.$persona->id,
            'nombres'=>'required',
            'apellidos'=>'required',
            'sexo'=>'required|in:M,F',
            'fecha_nacimiento'=>'required|date',
            'celular'=>'nullable'
        ]);

        $persona->update($request->all());

        return redirect()->route('personas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('personas.index');
    }
}
