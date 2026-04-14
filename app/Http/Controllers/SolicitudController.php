<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    /**
     * Donde el refugio ve todas las solicitudes
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->esRefugio()) {
            abort(403);
        }

        $solicitudes = Solicitud::whereHas('animal', function ($query) {
            $query->where('refugio_id', Auth::id());
        })->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request, $animalId)
    {


        $animal = Animal::findOrFail($animalId);

        $yaExiste = Solicitud::where('animal_id', $animalId)
            ->where('user_id', Auth::id())
            ->first();

        if ($yaExiste) {
            return redirect()->back()->with('error', 'Ya has solicitado este animal.');
        }

        Solicitud::create([
            'animal_id' => $animalId,
            'user_id' => Auth::id(),
            'estado' => 'pendiente',
        ]);

        return redirect()->back()->with('success', 'Solicitud enviada correctamente.');
        }



public function aceptarSolicitud(Solicitud $solicitud){
$animal = $solicitud->animal;

        if ($animal->refugio_id !== Auth::id()) {
            abort(403);
        }

        $solicitud->estado = 'aceptada';
        $solicitud->save();

        // Cambiar estado del animal a adoptado
        $animal->estado = 'adoptado';
        $animal->save();

        // Rechazar automáticamente las demás solicitudes
        Solicitud::where('animal_id', $animal->id)
            ->where('id', '!=', $solicitud->id)
            ->update(['estado' => 'rechazada']);

        return back()->with('success', 'Solicitud aceptada, animal adoptado.');
}


public function rechazarSolicitud(Solicitud $solicitud){
$animal = $solicitud->animal;

        if ($animal->refugio_id !== Auth::id()) {
            abort(403);
        }

        $solicitud->estado = 'rechazada';
        $solicitud->save();

        return back()->with('success', 'Solicitud rechazada.');

}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
