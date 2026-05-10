<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use App\Mail\SolicitudAceptada;
use App\Mail\SolicitudRechazada;
use Illuminate\Support\Facades\Mail;

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
     * Store a newly created resource in storage.
     */
   public function store(Request $request, $animalId)
    {

       // $this->authorize('create', Solicitud::class);

        $animal = Animal::findOrFail($animalId);

        $yaExiste = Solicitud::where('animal_id', $animalId)
            ->where('usuario_id', Auth::id())
            ->first();

        if ($yaExiste) {
            return redirect()->back()->with('error', 'Ya has solicitado este animal.');
        }

        if($animal->estado !== 'disponible') {
            return redirect()->back()->with('error', 'Este animal ya no está disponible.');
        }

        Solicitud::create([
            'animal_id' => $animalId,
            'usuario_id' => Auth::id(),
            'estado' => 'pendiente',
            'mensaje' => $request->mensaje,
        ]);

        return redirect()->back()->with('success', 'Solicitud enviada correctamente.');
        }





public function aceptarSolicitud(Solicitud $solicitud)
{
    //$this->authorize('update', $solicitud);

    $animal = $solicitud->animal;

    $solicitud->estado = 'aceptada';
    $solicitud->save();

    $animal->estado = 'adoptado';
    $animal->save();

    // Rechazar automáticamente las demás solicitudes
    Solicitud::where('animal_id', $animal->id)
        ->where('id', '!=', $solicitud->id)
        ->update(['estado' => 'rechazada']);

    // ✅ Notificación al usuario que fue aceptado
    Mail::to($solicitud->user->email)->send(new SolicitudAceptada($solicitud));

    // ✅ Notificación a los usuarios rechazados
    $rechazadas = Solicitud::where('animal_id', $animal->id)
        ->where('id', '!=', $solicitud->id)
        ->get();

    foreach ($rechazadas as $s) {
        Mail::to($s->user->email)->send(new SolicitudRechazada($s));
    }

    return back()->with('success', 'Solicitud aceptada, animal adoptado.');
}

public function rechazarSolicitud(Solicitud $solicitud)
{
    //$this->authorize('update', $solicitud);

    $solicitud->estado = 'rechazada';
    $solicitud->save();

    // ✅ Notificación al usuario que fue rechazado
    Mail::to($solicitud->user->email)->send(new SolicitudRechazada($solicitud));

    return back()->with('success', 'Solicitud rechazada.');
}



    /**
     * Display the specified resource.
     */
public function show(Solicitud $solicitud)
{
    $user = Auth::user();

    // Validación de acceso: solo el refugio propietario o el admin pueden ver
    if (!$user->esRefugio() && !$user->esAdmin()) {
        abort(403);
    }

    if ($user->esRefugio() && $solicitud->animal->refugio_id !== $user->id) {
        abort(403);
    }

    return view('solicitudes.show', compact('solicitud'));
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
    public function destroy(Solicitud $solicitud)
    {
        $user = Auth::user();

        if ($solicitud->usuario_id !== $user->id) {
            abort(403);
        }

        if ($solicitud->estado !== 'pendiente') {
            return back()->with('error', 'No puedes cancelar una solicitud ya procesada.');
        }

        $solicitud->delete();

        return back()->with('success', 'Solicitud cancelada correctamente.');
    }

}
