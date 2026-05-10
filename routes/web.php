<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [AnimalController::class, 'index'])->name('home');


// Ruta para Adopta (adopta/index.blade.php)
Route::get('/adopta', [AnimalController::class, 'adopta'])->name('adopta.index');

// Ruta para Contacto (contacto/index.blade.php)
Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto.index');

// Rutas para Animales (Index, Create, Show, etc.)
Route::resource('animales', AnimalController::class);

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

    // SOLICITAR ADOPCIÓN (IMPORTANTE: aquí protegido)
    Route::post('/animales/{animal}/solicitar', [SolicitudController::class, 'store'])
        ->name('solicitudes.store');

     // SOLICITUDES (REFUGIO / LOGUEADOS POR AHORA)
    Route::get('/solicitudes', [SolicitudController::class, 'index'])
        ->name('solicitudes.index');

    Route::patch('/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptarSolicitud'])
        ->name('solicitudes.aceptar');

    Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazarSolicitud'])
        ->name('solicitudes.rechazar');

});





require __DIR__.'/auth.php';

Route::view('/faq', 'faq')->name('faq');
Route::view('/proceso-adopcion', 'proceso')->name('proceso');
Route::view('/voluntariado', 'voluntariado')->name('voluntariado');
Route::view('/donaciones', 'donaciones')->name('donaciones');

Route::view('/politica-privacidad', 'privacidad')->name('privacidad');
Route::view('/aviso-legal', 'legal')->name('legal');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['es', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

