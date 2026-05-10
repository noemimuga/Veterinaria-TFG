<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [AnimalController::class, 'index'])->name('home');

// Adoptar
Route::get('/adopta', [AnimalController::class, 'adopta'])->name('adopta.index');

// Contacto
Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto.index');

// Info estática
Route::view('/faq', 'faq')->name('faq');
Route::view('/proceso-adopcion', 'proceso')->name('proceso');
Route::view('/voluntariado', 'voluntariado')->name('voluntariado');
Route::view('/donaciones', 'donaciones')->name('donaciones');
Route::view('/politica-privacidad', 'privacidad')->name('privacidad');
Route::view('/aviso-legal', 'legal')->name('legal');

// Cambio de idioma
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['es', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | RUTAS PARA USUARIOS
    |--------------------------------------------------------------------------
    */
    Route::middleware('can:usuario')->group(function () {
        // Solicitar adopción
        Route::post('/animales/{animal}/solicitar', [SolicitudController::class, 'store'])
            ->name('solicitudes.store');
    });

    /*
    |--------------------------------------------------------------------------
    | RUTAS PARA REFUGIOS
    |--------------------------------------------------------------------------
    */
    Route::middleware('can:refugio')->group(function () {
        // Ver todas las solicitudes
        Route::get('/solicitudes', [SolicitudController::class, 'index'])
            ->name('solicitudes.index');

        // Aceptar / Rechazar solicitudes
        Route::patch('/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptarSolicitud'])
            ->name('solicitudes.aceptar');

        Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazarSolicitud'])
            ->name('solicitudes.rechazar');

        // Publicar animales (ya que refugio puede crear)
        Route::resource('animales', AnimalController::class)->except(['index', 'show']);
    });

});

// Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';

// Mostrar animales públicos
Route::resource('animales', AnimalController::class)->only(['index', 'show']);
