<?php

namespace App\Http\Controllers;

use App\Models\Profesores;
use App\Models\User;
use App\Models\UserXProfesores;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProfesoresController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesores::all();
        return view('profesores.index', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profesores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $profesor=Profesores::create($request->all());
        $usuario=User::create([
            'name'=>$request->nombre_profesor,
            'email'=>$request->email_profesor,
            'password'=>$request->documento,
        ]);
        $userprofe=UserXProfesores::create([
            'user_id'=>$usuario->id,
            'profesor_id'=>$profesor->id,
        ]);
 

        return redirect()->route('profesores.index')->with('success', 'Profesor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesores $profesor)
    {
        return view('profesores.show', compact('profesor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesores $profesor)
    {
        return view('profesores.edit', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profesor=Profesores::find($id);
        $request->validate([
            'nombre_profesor' => 'sometimes|required|string|max:255',
            'email_profesor' => 'sometimes|required|email|max:255',
            'telefono_profesor' => 'nullable|string|max:15',
        ]);

        $profesor->update($request->all());
        return redirect()->route('profesores.index')->with('success', 'Profesor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

$profesor=Profesores::find($id);
        $profesor->delete();
        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado exitosamente.');
    }
}
