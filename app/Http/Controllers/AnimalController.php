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
    public function index(Request $request)  
    {
        $query = Animal::query();

        // Filtro de búsqueda (nombre o raza)
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                    ->orWhere('raza', 'like', "%{$buscar}%");
            });
        }  

        // Filtro de especie
        if ($request->filled('especie')) {
            $query->where('especie', $request->especie);
        }

        // Filtro de edad
        if ($request->filled('edad')) {
            $query->where('edad', $request->edad);
        }

        $animales = $query->get();

        return view('animales.index', compact('animales'));
    }

    public function adopta(Request $request)
    {
        $query = Animal::where('estado', 'disponible');

        // Filtro de búsqueda (nombre o raza)
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
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
            if ($request->edad == 'cachorro') {
                $query->whereBetween('edad', [0, 1]);
            } elseif ($request->edad == 'joven') {
                $query->whereBetween('edad', [1, 3]);
            } elseif ($request->edad == 'adulto') {
                $query->whereBetween('edad', [3, 7]);
            } elseif ($request->edad == 'senior') {
                $query->where('edad', '>', 7);
            }
        }
        // Filtro por sexo
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
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
 public function edit($id)
{
    // Seguridad: Verificar que el usuario esté logueado y sea refugio
    if (!auth()->check() || !auth()->user()->esRefugio()) {
        abort(403, 'No eres un refugio autorizado.');
    }

    //  Buscar al animal en Railway por su ID
    $animal = Animal::findOrFail($id);

    //  Seguridad: Verificar que el refugio_id del animal coincida con el ID del usuario logueado
    if ((int)$animal->refugio_id !== (int)auth()->id()) {
        abort(403, 'No tienes permiso para editar este animal.');
    }

    // Si todo está bien, mostrar la vista
    return view('animales.edit', compact('animal'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $animal = Animal::findOrFail($id);

        if ($animal->refugio_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:50',
            'raza' => 'nullable|string|max:50',
            'edad' => 'integer',
            'descripcion' => 'nullable|string',
        ]);

        $animal->update($request->all());

        return redirect()->route('refugio.dashboard')
            ->with('success', 'Animal actualizado correctamente');
        }

public function update(Request $request, $id)
    {
        //Seguridad: Verificar que el usuario esté logueado y sea un refugio
        if (!Auth::check() || !Auth::user()->esRefugio()) {
            abort(403, 'No tienes autorización para realizar esta acción.');
        }

        //Buscar al animal en Railway
        $animal = Animal::findOrFail($id);

        //Seguridad: Verificar que el animal pertenezca al refugio activo
        if ((int)$animal->refugio_id !== (int)Auth::id()) {
            abort(403, 'No tienes permiso para editar este animal.');
        }

        //Validar los datos del formulario con mensajes personalizados en español
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|in:perro,gato',
            'estado' => 'required|string|in:disponible,en proceso,adoptado',
            'descripcion' => 'required|string|min:10',
            'raza' => 'nullable|string|max:50',
            'edad' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'especie.required' => 'Debes seleccionar si es un Perro o un Gato.',
            'estado.required' => 'El estado del animal es obligatorio.',
            'descripcion.required' => '¡Ayuda al animal! Pon una descripción sobre su carácter o historia.',
            'descripcion.min' => 'La descripción es demasiado corta (mínimo 10 caracteres).',
            'edad.integer' => 'La edad debe ser un número entero.',
            'edad.min' => 'La edad no puede ser un número negativo.',
            'foto.image' => 'El archivo seleccionado debe ser una imagen válida.',
            'foto.mimes' => 'La foto debe estar en formato JPG, PNG, JPEG o WEBP.',
            'foto.max' => 'La foto pesa demasiado. El tamaño máximo permitido es de 2 MB.',
        ]);

        // Gestión de la Foto
        $ruta = $animal->foto; // Por defecto mantenemos la ruta de la foto que ya tenía

        if ($request->hasFile('foto')) {
            // Si el animal ya tenía una foto guardada antes, la borramos del almacenamiento para no acumular basura
            if ($animal->foto) {
                Storage::disk('public')->delete(str_replace('animales/', '', $animal->foto));
            }
            // Guardamos la nueva foto en storage/app/public/animales
            $ruta = $request->file('foto')->store('animales', 'public');
        }

        //Actualizar el registro en Railway
        $animal->update([
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'estado' => $request->estado,
            'descripcion' => $request->descripcion,
            'foto' => $ruta,
        ]);

        //Redirección con mensaje de éxito de sesión
        return redirect()->route('refugio.dashboard')->with('success', 'Ficha de ' . $animal->nombre . ' actualizada correctamente.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $animal = Animal::findOrFail($id);

        if ($animal->refugio_id !== Auth::id()) {
            abort(403);
        }

        $animal->delete();

        return redirect()->route('refugio.dashboard')
            ->with('success', 'Animal eliminado');
        }
}
