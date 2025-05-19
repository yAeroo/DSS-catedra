<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoEmpresaController;
use App\Http\Controllers\AuthController;

// Proceso de autenticación ====
Route::middleware(['auth.guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/auth', [AuthController::class, 'login'])->name('login.auth');
});

Route::middleware(['auth.login'])->group(function () {
    // Rutas protegidas
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Página principal
    Route::get('/', function () {
        return view('index');
    })->name('index');

    // Gestión de Empresas
    Route::get('gestion_empresas', [TipoEmpresaController::class, 'index'])->name('tipos-empresa.index');
    Route::post('gestion_empresas', [TipoEmpresaController::class, 'store'])->name('tipos-empresa.store');
    Route::put('gestion_empresas/{id}', [TipoEmpresaController::class, 'update'])->name('tipos-empresa.update');
    Route::delete('gestion_empresas/{id}', [TipoEmpresaController::class, 'destroy'])->name('tipos-empresa.destroy');

    // Gestión de Convenios
    Route::get('listado_convenios', function () {
        return view('listado_convenios');
    })->name('listado_convenios');
});
