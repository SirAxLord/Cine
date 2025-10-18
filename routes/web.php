<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\adminController;
use App\Http\Controllers\sucursalesController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
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

        Route::get('sucursales', [sucursalesController::class, 'index'])->name('sucursales.index');
    Route::post('sucursales/save', [sucursalesController::class, 'save'])->name('sucursales.save');
    Route::match(['put','patch'], 'sucursales/update/{id}', [sucursalesController::class, 'update'])->name('sucursales.update');
        Route::delete('sucursales/delete/{id}', [sucursalesController::class, 'delete'])->name('sucursales.delete');
    Route::get('sucursales/modifica/{id}', [sucursalesController::class, 'show'])->name('sucursales.show');
});

require __DIR__.'/auth.php';
