<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use Illuminate\Http\Request;

class AmbienteController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ambientes = Ambiente::all();
        return view('ambientes.index', compact('ambientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ambientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'piso' => 'required|integer',
        ]);

        Ambiente::create($request->all());
        return redirect()->route('ambientes.index')->with('success', 'Ambiente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ambiente $ambiente)
    {
        return view('ambientes.show', compact('ambiente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ambiente $ambiente)
    {
        return view('ambientes.edit', compact('ambiente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ambiente $ambiente)
    {

        $request->validate([
            'codigo' => 'sometimes|required|string|max:255',
            'nombre' => 'sometimes|required|string|max:255',
            'piso' => 'sometimes|required|integer',
        ]);

        $ambiente->update($request->all());
        return redirect()->route('ambientes.index')->with('success', 'Ambiente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ambiente $ambiente)
    {
        $ambiente->delete();
        return redirect()->route('ambientes.index')->with('success', 'Ambiente eliminado exitosamente.');
    }
}
