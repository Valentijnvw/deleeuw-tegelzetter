<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\OpdrachtController;
use App\Http\Controllers\MoneybirdController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Mail\Test;

use App\Services\MoneybirdService;

use App\Models\MoneybirdContact;
use App\Models\Opdracht;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/settings/setAppearance', [SettingsController::class, 'setAppearance'])->name('userSettings.setAppearance');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/gebruikers')->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('user.list');
        Route::get('/toevoegen', [UserController::class, 'add'])->name('user.add');

        Route::patch('/bewerken/details', [UserController::class, 'updateDetails'])->name('user.update.details');
        Route::patch('/bewerken/wachtwoord', [UserController::class, 'updatePassword'])->name('user.update.password');
        Route::post('/verwijderen', [UserController::class, 'delete'])->name('user.delete');
    });

    Route::prefix('/opdrachten')->group(function () {
        Route::get('/', [OpdrachtController::class, 'list'])->name('opdracht.list');
        Route::get('/toevoegen', [OpdrachtController::class, 'add'])->name('opdracht.add');
        Route::post('/toevoegen', [OpdrachtController::class, 'store'])->name('opdracht.store');

    });
});

// TEST ROUTES

Route::get('moneybird', function() {
    // $opdr = Opdracht::first();
    // dd($opdr->moneybirdContact());
});

Route::get('mail', function() {
    // Mail::to('valentijnvanwinden@gmail.com')->send(new Test());
});

require __DIR__.'/auth.php';
