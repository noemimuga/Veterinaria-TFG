<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animales = Animal::where('estado', 'disponible')->get();
        return view('animales.index', compact('animales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * SOLO PARA REFUGIOS
     */
    public function create()
    {
        //Se comprueba si el usuario logueado es refugio
        //Si no es un refugio, devuelve un error
        if (!Auth::user()->esRefugio()) {
            abort(403);
        }
        return view('animales.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * SOLO REFUGIOS
     */
    public function store(Request $request)
    {
       //Se comprueba si el usuario logueado es refugio
        //Si no es un refugio, devuelve un error
    if (!Auth::user()->esRefugio()) {
            abort(403);
        }

        //Se validan los datos del formulario
           $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:50',
            'raza' => 'nullable|string|max:50',
            'edad' => 'integer',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image',
        ]);

        //Si hay una foto subida , se guarda en storage/app/public/animales
        // $ruta guarda la ruta del archivo para la base de datos.
        //Si no hay foto subida, $ruta queda null
    $ruta = null;
    if ($request->hasFile('foto')) {
        $ruta = $request->file('foto')->store('animales', 'public');

    }
     Animal::create([
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'descripcion' => $request->descripcion,
            'foto' => $ruta,
            'refugio_id' => Auth::id(),
            'estado' => 'disponible',
        ]);

     return redirect()->route('animales.index')->with('success', 'Animal creado correctamente.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return view('animales.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
