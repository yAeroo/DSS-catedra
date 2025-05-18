<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Proceso de autenticación ====
Route::middleware(['auth.guest'])->group(function () {
    Route::get('/login', function () {return view('login');})->name('login');
    Route::post('/auth', [AuthController::class, 'login'])->name('login.auth');
});

Route::middleware(['auth.login'])->group(function () {
    // Rutas protegidas
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () { return view('index'); })->name('index');
    Route::get('/gestion_empresas', function () { return view('gestion_empresas'); })->name('gestion_empresas');
    Route::get('/listado_convenios', function () { return view('listado_convenios'); })->name('listado_convenios');
});
