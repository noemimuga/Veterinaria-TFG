<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefugioController extends Controller
{
    public function dashboard()
    {
        // Obtener todas las solicitudes ordenadas por más recientes
        $solicitudes = Solicitud::with(['usuario', 'animal'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Contar por estado
        $pendientes = $solicitudes->where('estado', 'pendiente')->count();
        $aceptadas = $solicitudes->where('estado', 'aceptada')->count();
        $rechazadas = $solicitudes->where('estado', 'rechazada')->count();

        return view('refugio.dashboard', compact('solicitudes', 'pendientes', 'aceptadas', 'rechazadas'));
    }

    public function aceptarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'aceptada';
        $solicitud->save();

        return redirect()->route('refugio.dashboard')
            ->with('success', 'Solicitud aceptada correctamente');
    }

    public function rechazarSolicitud(Request $request, $id)
    {
        $request->validate([
            'mensaje_rechazo' => 'required|string|min:10'
        ]);

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'rechazada';
        $solicitud->mensaje_rechazo = $request->mensaje_rechazo;
        $solicitud->save();

        return redirect()->route('refugio.dashboard')
            ->with('success', 'Solicitud rechazada correctamente');
    }
}
