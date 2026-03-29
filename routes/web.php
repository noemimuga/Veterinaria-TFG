<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * Rutas públicas
 */
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/animales', [AnimalController::class, 'index'])->name('animales.index');
Route::get('/animales/{id}', [AnimalController::class, 'show'])->name('animales.show');
Route::get('/animales/{animal}', [AnimalController::class, 'show'])->name('animales.show');


/**
 * Rutas protegidas
 */

Route::middleware('auth')->group(function () {

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Enviar solicitud de adopción
    Route::post('/animales/{animal}/solicitar', [SolicitudController::class, 'store'])
        ->name('solicitudes.store');

    // Solo refugios
    Route::middleware('refugio')->group(function () {

        Route::post('/animales', [AnimalController::class, 'store'])->name('animales.store');
        Route::get('/animales/{animal}/editar', [AnimalController::class, 'edit'])->name('animales.edit');
        Route::put('/animales/{animal}', [AnimalController::class, 'update'])->name('animales.update');
        Route::delete('/animales/{animal}', [AnimalController::class, 'destroy'])->name('animales.destroy');

        Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
        Route::patch('/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptarSolicitud'])
            ->name('solicitudes.aceptar');
        Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazarSolicitud'])
            ->name('solicitudes.rechazar');
    });
});

require __DIR__ . '/auth.php';



