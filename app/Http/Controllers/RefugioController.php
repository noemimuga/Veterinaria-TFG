<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefugioController extends Controller
{
    // Método para mostrar el dashboard del refugio
    public function dashboard()
    {
        // Obtener todas las solicitudes ordenadas por más recientes
        $solicitudes = Solicitud::with(['user', 'animal'])
            ->orderBy('created_at', 'desc') //ordena las solicitudes desde la mas reciente
            ->get();

        // Cuenta cuántas solicitudes están pendientes
        $pendientes = $solicitudes->where('estado', 'pendiente')->count();
        // Cuenta cuántas solicitudes están aceptadas
        $aceptadas = $solicitudes->where('estado', 'aceptada')->count();
        // Cuenta cuántas solicitudes están rechazadas
        $rechazadas = $solicitudes->where('estado', 'rechazada')->count();

        // Devuelve la vista del dashboard
        return view('refugio.dashboard', compact('solicitudes', 'pendientes', 'aceptadas', 'rechazadas'));
    }

    // método para aceptar una solicitud
    public function aceptarSolicitud($id)
    {
        // busca la solicitud por id
        $solicitud = Solicitud::findOrFail($id);
        // Cambia el esttado de la solicitud a aceptada
        $solicitud->estado = 'aceptada';
        // guarda los cambios en la bbdd
        $solicitud->save();

        // Redirige al dashboard mostrando un mensaje 
        return redirect()->route('refugio.dashboard')
            ->with('success', 'Solicitud aceptada correctamente');
    }

    // método para rechazar una solicitud
    public function rechazarSolicitud(Request $request, $id)
    {
        // Valida el mensaje de rechazo
        // Debe ser obligatorio y minimo 10 caracteres
        $request->validate([
            'mensaje_rechazo' => 'required|string|min:10'
        ]);

        // Busca la solicitud por id
        $solicitud = Solicitud::findOrFail($id);
        // Cambia el estado a rechazada
        $solicitud->estado = 'rechazada';
        // Guarda el mensaje de rechazo escrito por el refugio
        $solicitud->mensaje_rechazo = $request->mensaje_rechazo;
        $solicitud->save();

        return redirect()->route('refugio.dashboard')
            ->with('success', 'Solicitud rechazada correctamente');
    }
}
