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
     * Muestra el formulario de adopción
     */
    public function create(int $animal_id)
    {
        $animal = Animal::findOrFail($animal_id);
        return view('solicitudes.create', compact('animal'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $animal_id)
    {

        // 1. Asegurar usuario logueado
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para enviar una solicitud.');
        }

        // 2. Validación
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'telefono'        => 'required|string|regex:/^[0-9\s]+$/',
            'vivienda'        => 'required|string',
            'motivo'          => 'required|string',
        ], [
            // Mensajes personalizados en español
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo puede contener números.',
            'vivienda.required' => 'Debes indicar cómo es tu vivienda.',
            'motivo.required' => 'Debes indicar el motivo de la adopción.',
        ]);

        // 3. Comprobar que el animal existe
        $animal = \App\Models\Animal::findOrFail($animal_id);

        // 4. Evitar solicitudes duplicadas
        $existe = \App\Models\Solicitud::where('usuario_id', auth()->id())
            ->where('animal_id', $animal_id)
            ->exists();


        if ($existe) {
            \Log::warning('Solicitud duplicada detectada');
            return redirect()
                ->route('solicitudes.create', $animal_id)
                ->with('error', 'Ya has enviado una solicitud para este animal.')
                ->withInput();
        }

        try {

            // 5. Guardar solicitud
            $solicitud = new \App\Models\Solicitud();

            $solicitud->usuario_id = auth()->id();
            $solicitud->animal_id = $animal_id;
            $solicitud->nombre_completo = $request->nombre_completo;
            $solicitud->datos_contacto = $request->telefono;
            $solicitud->vivienda = $request->vivienda;
            $solicitud->motivo = $request->motivo;
            $solicitud->estado = 'pendiente';

            $solicitud->save();

            return redirect()
                ->route('animales.show', $animal_id)
                ->with('success', '¡Solicitud enviada correctamente!');
        } catch (\Exception $e) {

            \Log::error($e);

            return back()
                ->with('error', 'No se pudo guardar la solicitud. Inténtalo de nuevo.')
                ->withInput();
        }
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

        // Notificación al usuario que fue aceptado
        Mail::to($solicitud->user->email)->send(new SolicitudAceptada($solicitud));

        //Notificación a los usuarios rechazados
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

        //Notificación al usuario que fue rechazado
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
