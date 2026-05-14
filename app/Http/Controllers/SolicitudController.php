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

    public function aceptarSolicitud($id)
    {
        // Buscamos la solicitud cargando al usuario y al animal
        $solicitud = Solicitud::with(['animal', 'user'])->findOrFail($id);

        // 2. Aceptamos esta solicitud
        $solicitud->estado = 'aceptada';
        $solicitud->save();

        // RECHAZAR EL RESTO: Buscamos todas las solicitudes pendientes de ESTE animal
        // y las pasamos a 'rechazada' automáticamente.
        Solicitud::where('animal_id', $solicitud->animal_id)
            ->where('id', '!=', $id) // No rechazamos la que acabamos de aceptar
            ->where('estado', 'pendiente')
            ->update(['estado' => 'rechazada']);

        // ENVIAR EMAIL: Buscamos el email en la tabla 'users'
        $emailDestino = $solicitud->user->email ?? null;

        if ($emailDestino) {
            Mail::to($emailDestino)->send(new SolicitudAceptada($solicitud));
        }

        return redirect()->route('refugio.dashboard')
            ->with('success', 'Solicitud aceptada. Las demás solicitudes para este animal han sido rechazadas.');
    }


    public function rechazarSolicitud($id)
{
    // 1. Buscamos la solicitud por su ID
    $solicitud = Solicitud::findOrFail($id);

    // 2. Cambiamos el estado a rechazada
    $solicitud->estado = 'rechazada';
    $solicitud->save();

    // 3. Volvemos al panel con un mensaje de éxito
    return redirect()->route('refugio.dashboard')
        ->with('success', 'La solicitud ha sido rechazada correctamente.');
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
