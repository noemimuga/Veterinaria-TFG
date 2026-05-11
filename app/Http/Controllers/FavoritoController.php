<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;

class FavoritoController extends Controller
{
    public function store($animalId)
    {
        $user = Auth::user();

        $existe = Favorito::where('user_id', $user->id)
            ->where('animal_id', $animalId)
            ->first();

        if ($existe) {
            return back()->with('error', 'Ya está en favoritos');
        }

        Favorito::create([
            'user_id' => $user->id,
            'animal_id' => $animalId,
        ]);

        return back()->with('success', 'Añadido a favoritos ❤️');
    }
    public function index()
    {
        $favoritos = auth()->user()
            ->favoritos()
            ->with('animal')
            ->get();

        return view('favoritos.index', compact('favoritos'));
    }

    public function destroy(Favorito $favorito)
{
    $favorito->delete();

    return back()->with('success', 'Eliminado de favoritos 💔');
}
}
