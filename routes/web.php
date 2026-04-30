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

Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| ANIMALES (PÚBLICO)
|--------------------------------------------------------------------------
*/

// Resource completo (index, show, create, store, edit, update, destroy)
Route::resource('animales', AnimalController::class);

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (LOGIN)
|--------------------------------------------------------------------------
*/

//Route::middleware('auth')->group(function () {

    /*
    |-------------------------
    | PERFIL (Laravel Breeze)
    |-------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |-------------------------
    | DASHBOARD
    |-------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |-------------------------
    | SOLICITUDES (USUARIOS)
    |-------------------------
    */
    Route::post('/animales/{animal}/solicitar', [SolicitudController::class, 'store'])
        ->name('solicitudes.store');

    /*
    |-------------------------
    | SOLO REFUGIOS
    |-------------------------
    */
    Route::middleware('refugio')->group(function () {

        // GESTIÓN DE SOLICITUDES
        Route::get('/solicitudes', [SolicitudController::class, 'index'])
            ->name('solicitudes.index');

        Route::patch('/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptarSolicitud'])
            ->name('solicitudes.aceptar');

        Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazarSolicitud'])
            ->name('solicitudes.rechazar');
    });
//});

/*
|--------------------------------------------------------------------------
| AUTH (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
