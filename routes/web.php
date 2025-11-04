<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\adminController;
use App\Http\Controllers\sucursalesController;
use App\Http\Controllers\salasController;
use App\Http\Controllers\peliculasController;
use App\Http\Controllers\funcionesAdminController;
use App\Http\Controllers\funcionesController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $salas = \App\Models\sala::all();
    return view('dashboard', compact('salas'));
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

        //Rutas de Sucursales
        Route::get('sucursales/index', [sucursalesController::class, 'index'])->name('sucursales.index');
        Route::post('sucursales/save', [sucursalesController::class, 'save'])->name('sucursales.save');
        Route::match(['put','patch'], 'sucursales/update/{id}', [sucursalesController::class, 'update'])->name('sucursales.update');
        Route::delete('sucursales/delete/{id}', [sucursalesController::class, 'delete'])->name('sucursales.delete');
        Route::get('sucursales/modifica/{id}', [sucursalesController::class, 'show'])->name('sucursales.show');

        //Rutas de Salas
        Route::get('salas/index', [salasController::class, 'index'])->name('salas.index');
        Route::post('salas/save', [salasController::class, 'save'])->name('salas.save');
        Route::match(['put','patch'], 'salas/update/{id}', [salasController::class, 'update'])->name('salas.update');
        Route::delete('salas/delete/{id}', [salasController::class, 'delete'])->name('salas.delete');
        Route::get('salas/modifica/{id}', [salasController::class, 'show'])->name('salas.show');

        //Rutas de Peliculas
        Route::get('peliculas/index', [peliculasController::class, 'index'])->name('peliculas.index');
        Route::post('peliculas/save', [peliculasController::class, 'save'])->name('peliculas.save');
        Route::match(['put','patch'], 'peliculas/update/{id}', [peliculasController::class, 'update'])->name('peliculas.update');
        Route::delete('peliculas/delete/{id}', [peliculasController::class, 'delete'])->name('peliculas.delete');
        Route::get('peliculas/modifica/{id}', [peliculasController::class, 'show'])->name('peliculas.show');

    //Rutas de Funciones (Administrador)
    Route::get('funciones/index', [funcionesAdminController::class, 'index'])->name('funciones.index');
    Route::post('funciones/save', [funcionesAdminController::class, 'save'])->name('funciones.save');
    Route::match(['put','patch'], 'funciones/update/{id}', [funcionesAdminController::class, 'update'])->name('funciones.update');
    Route::delete('funciones/delete/{id}', [funcionesAdminController::class, 'delete'])->name('funciones.delete');
    Route::get('funciones/modifica/{id}', [funcionesAdminController::class, 'show'])->name('funciones.show');

    // Rutas de Funciones (Usuario)
    Route::get('funciones', [funcionesController::class, 'index'])->name('funciones.user.index');
    Route::get('funciones/detalle/{id}', [funcionesController::class, 'show'])->name('funciones.user.show');

    // Reporte PDF de Películas por Sala
    Route::post('reportes/peliculas-salas', [adminController::class, 'generarReportePeliculasSalas'])->name('reportes.peliculas-salas');

});

require __DIR__.'/auth.php';
