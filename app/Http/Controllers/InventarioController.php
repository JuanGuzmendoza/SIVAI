<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Ambiente;
use App\Models\Profesores;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventario::with(['ambiente', 'profesor'])->get();
        return view('inventarios.index', compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ambientes = Ambiente::all();
        $profesores = Profesores::all();
        return view('inventarios.create', compact('ambientes', 'profesores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        Inventario::create([
            'R'=>$request->R,
            'centro'=>$request->centro,
            'modelo'=>$request->modelo,
            'consec'=>$request->consec,
            'desc'=>$request->desc,
            'descripcion_actual'=>$request->descripcion_actual,
            'tipo'=>$request->tipo,
            'mod'=>$request->mod,
            'placa'=>$request->placa,
            'atributos'=>$request->atributos,
            'fecha_adquisicion'=>$request->fecha_adquisicion,
            'valor_ingreso'=>$request->valor_ingreso,
            'ambiente_id'=>$request->ambiente_id,
            'profesor_id'=>$request->profesor_id,
        ]);
        $Inventario=Inventario::all();
        $Profesores=Profesores::all();
        $Ambientes=Ambiente::all();
        return view('dashboard',compact('Ambientes','Profesores','Inventario'));
     }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        return view('inventarios.show', compact('inventario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        $ambientes = Ambiente::all();
        $profesores = Profesores::all();
        return view('inventarios.edit', compact('inventario', 'ambientes', 'profesores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'R' => 'sometimes|required|string|max:255',
            'centro' => 'sometimes|required|string|max:255',
            'modelo' => 'sometimes|required|string|max:255',
            'consec' => 'sometimes|required|string|max:255',
            'desc' => 'nullable|string|max:255',
            'descripcion_actual' => 'nullable|string|max:255',
            'tipo' => 'sometimes|required|string|max:255',
            'mod' => 'nullable|string|max:255',
            'placa' => 'nullable|string|max:255',
            'atributos' => 'nullable|string',
            'fecha_adquisicion' => 'sometimes|required|date',
            'valor_ingreso' => 'sometimes|required|numeric',
            'ambiente_id' => 'sometimes|required|exists:ambientes,id',
            'profesor_id' => 'sometimes|required|exists:profesores,id',
        ]);

        $inventario->update($request->all());
        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado exitosamente.');
    }
}
