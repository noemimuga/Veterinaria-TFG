<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Solicitud;

class RefugioController extends Controller
{
    public function dashboard()
    {
        $refugio = auth()->user();

        $animales = Animal::where('refugio_id', auth()->id())->get();

        $solicitudesPendientes = Solicitud::whereHas('animal', function ($query) {
            $query->where('refugio_id', auth()->id());
        })
        ->where('estado', 'pendiente')
        ->count();

        return view('refugio.dashboard', compact(
            'animales',
            'solicitudesPendientes'
        ));
    }
}
