<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)  // ← AGREGADO $request
    {
        $query = Animal::query();
        
        // Filtro de búsqueda (nombre o raza)
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('raza', 'like', "%{$buscar}%");
            });
        }  // ← AGREGADA llave de cierre

        // Filtro de especie
        if ($request->filled('especie')) {
            $query->where('especie', $request->especie);
        }

        // Filtro de edad
        if ($request->filled('edad')) {
            $query->where('edad', $request->edad);
        }

        // Opcional: filtrar solo disponibles
        // $query->where('estado', 'disponible');

        $animales = $query->get();

        return view('animales.index', compact('animales'));
    }  

public function adopta(Request $request)
{
    $query = Animal::where('estado', 'disponible');
    
    // Filtro de búsqueda (nombre o raza)
    if ($request->filled('buscar')) {
        $buscar = $request->buscar;
        $query->where(function($q) use ($buscar) {
            $q->where('nombre', 'like', "%{$buscar}%")
              ->orWhere('raza', 'like', "%{$buscar}%");
        });
    }

    // Filtro de especie
    if ($request->filled('especie')) {
        $query->where('especie', $request->especie);
    }

    // Filtro de raza
    if ($request->filled('raza')) {
        $query->where('raza', 'like', "%{$request->raza}%");
    }

    // Filtro de edad
    if ($request->filled('edad')) {
        $query->where('edad', $request->edad);
    }
    // Filtro por sexo
    if($request->filled('sexo')){
        $query->where('sexo', $request->edad);
    }

    $animales = $query->get();

    return view('adopta.index', compact('animales'));
}


    /**
     * Show the form for creating a new resource.
     * SOLO PARA REFUGIOS
     */
    public function create()
    {
       //Se comprueba si el usuario logueado es refugio
        //Si no es un refugio, devuelve un error
       if (!Auth::check() || !Auth::user()->esRefugio()) {
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
        if (!Auth::check() || !Auth::user()->esRefugio()) {
            abort(403);
        }

        //Se validan los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:50',
            'raza' => 'nullable|string|max:50',
            'edad' => 'integer',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
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
        $animal = Animal::findOrFail($id);
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