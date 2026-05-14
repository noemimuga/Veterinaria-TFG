<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;

class FavoritoController extends Controller
{
    // Método para guardar un animal en favoritos
    public function store($animalId)
    {
        // Obtiene el usuario que ha iniciado sesión
        $user = Auth::user();

        // Busca si ya existe un favorito con este usuario y este animal
        $existe = Favorito::where('user_id', $user->id)
            ->where('animal_id', $animalId)
            ->first();

        // Si ya existe vuelve atrás mostrando un mensaje de error
        if ($existe) {
            return back()->with('error', 'Ya está en favoritos');
        }

        // Si no existe crea un nuevo registro en la tabla favoritos
        Favorito::create([
            'user_id' => $user->id,
            'animal_id' => $animalId,
        ]);
        // Redirige hacia atras mostrando un mensaje de éxito
        return back()->with('success', 'Añadido a favoritos');
    }

    // Método para mostrar todos los favoritos del usuario
    public function index()
    {

        // Obtiene el usuario autenticado
        // Accede a su relación favoritos()
        // with('animal') carga también los datos del animal relacionado
        $favoritos = auth()->user()
            ->favoritos()
            ->with('animal')
            ->get();

        // Devuelve la vista favoritos.index enviando la variable favoritos
        return view('favoritos.index', compact('favoritos'));
    }

    // Método para eliminar un favorito
    public function destroy(Favorito $favorito)
    {
        // Elimina el favorito de la base de datos
        $favorito->delete();

        // Vuelve atrás mostrando un mensaje de éxito
        return back()->with('success', 'Eliminado de favoritos');
    }
}
