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
| ANIMALES PÚBLICOS
|--------------------------------------------------------------------------
*/

Route::resource('animales', AnimalController::class)
    ->only(['index', 'show']);
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

   // PERFIL
    Route::get('/mi-cuenta', function () {
        return view('profile.custom');
    })->name('profile.custom');

  // FAVORITOS
    Route::post('/favoritos/{animal}', [FavoritoController::class, 'store'])
        ->name('favoritos.store');

    Route::get('/favoritos', [FavoritoController::class, 'index'])
        ->name('favoritos.index');

         Route::delete('/favoritos/{favorito}', [FavoritoController::class, 'destroy'])
        ->name('favoritos.destroy');

// SOLICITUDES DE ADOPCIÓN 
// Formulario de preguntas
    Route::get('/solicitar-adopcion/{animal_id}', [SolicitudController::class, 'create'])->name('solicitudes.create');
    // Guardar la solicitud completa
    Route::post('/solicitar-adopcion/{animal_id}', [SolicitudController::class, 'store'])->name('solicitudes.store');


    /*
    |-------------------------
    | PANEL REFUGIO
    |-------------------------
    */
    Route::middleware('can:refugio')->group(function () {
        // Dashboard principal del refugio
        Route::get('/refugio/dashboard', [RefugioController::class, 'dashboard'])
            ->name('refugio.dashboard');

              // Gestión de solicitudes
       Route::get('/refugio/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
        Route::post('/refugio/solicitud/{id}/aceptar', [SolicitudController::class, 'aceptarSolicitud'])->name('solicitudes.aceptar');
        Route::post('/refugio/solicitud/{id}/rechazar', [SolicitudController::class, 'rechazarSolicitud'])->name('solicitudes.rechazar');
        
        // CRUD animales SOLO refugio
        Route::resource('animales', AnimalController::class)->except(['index', 'show']);
    });
});



/*
|--------------------------------------------------------------------------
| AUTH 
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
