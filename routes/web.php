<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\RefugioController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [AnimalController::class, 'index'])->name('home');

// Adoptar (listado con filtros)
Route::get('/adopta', [AnimalController::class, 'adopta'])->name('adopta.index');

// Contacto
Route::view('/contacto', 'contacto.index')->name('contacto.index');

/*
|--------------------------------------------------------------------------
| PÁGINAS INFORMATIVAS
|--------------------------------------------------------------------------
*/

Route::view('/faq', 'faq')->name('faq');
Route::view('/proceso-adopcion', 'proceso')->name('proceso');
Route::view('/voluntariado', 'voluntariado')->name('voluntariado');
Route::view('/donaciones', 'donaciones')->name('donaciones');
Route::view('/politica-privacidad', 'privacidad')->name('privacidad');
Route::view('/aviso-legal', 'legal')->name('legal');

/*
|--------------------------------------------------------------------------
| CAMBIO DE IDIOMA
|--------------------------------------------------------------------------
*/

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

    /*
    |-------------------------
    | PERFIL
    |-------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |-------------------------
    | Favoritos
    |-------------------------
    */
    Route::post('/favoritos/{animal}', [FavoritoController::class, 'store'])
    ->name('favoritos.store');

    Route::get('/favoritos', [FavoritoController::class, 'index'])
        ->name('favoritos.index');

    Route::delete('/favoritos/{favorito}', [FavoritoController::class, 'destroy'])
        ->name('favoritos.destroy');

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
    | SOLICITUD DE ADOPCIÓN (USUARIOS)
    |-------------------------
    */
    Route::post('/animales/{animal}/solicitar', [SolicitudController::class, 'store'])
        ->name('solicitudes.store');

    /*
    |-------------------------
    | PANEL REFUGIO
    |-------------------------
    */
    Route::middleware('can:refugio')->group(function () {

        Route::get('/refugio/dashboard', [RefugioController::class, 'dashboard'])
            ->name('refugio.dashboard');

        Route::get('/solicitudes', [SolicitudController::class, 'index'])
            ->name('solicitudes.index');

        Route::patch('/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptarSolicitud'])
            ->name('solicitudes.aceptar');

        Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazarSolicitud'])
            ->name('solicitudes.rechazar');

        // CRUD animales SOLO refugio
        Route::resource('animales', AnimalController::class)
            ->except(['index', 'show']);
    });

});

/*
|--------------------------------------------------------------------------
| ANIMALES PÚBLICOS
|--------------------------------------------------------------------------
*/

Route::resource('animales', AnimalController::class)
    ->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| AUTH (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
