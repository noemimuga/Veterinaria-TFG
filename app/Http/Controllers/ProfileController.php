<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar el formulario del perfil del usuario
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

     /**
     * Actualizar la información del perfil del usuario
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Rellena los datos del usuario con los datos validados del formulario
        $request->user()->fill($request->validated());

        // Comprueba si el email ha sido modificado
        if ($request->user()->isDirty('email')) {
            // Si cambió el email, elimina la verificación anterior
            // paraque el usuario tenga que volver a verificarlo
            $request->user()->email_verified_at = null;
        }

         // Guarda los cambios en la base de datos
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Eliminar la cuenta del usuario
     */
    public function destroy(Request $request): RedirectResponse
    {
         // Valida que la contraseña introducida sea correcta
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

         // Obtiene el usuario autenticado
        $user = $request->user();

        // Cierra la sesión del usuario
        Auth::logout();

         // Elimina el usuario de la base de datos
        $user->delete();

        $request->session()->invalidate(); // Invalida la sesión actual
        $request->session()->regenerateToken(); // Regenera el token CSRF por seguridad

         // Redirige al inicio de la web
        return Redirect::to('/');
    }
}
