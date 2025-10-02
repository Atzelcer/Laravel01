<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('cursos', CursoController::class);
    Route::resource('personas', PersonaController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('inscripciones', InscripcionController::class);
});

require __DIR__.'/auth.php';
