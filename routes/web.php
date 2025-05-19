<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TipoEmpresaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ConveniosController;

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

    Route::get('/', function () { return view('index'); })->name('index');

    // Gestión de Tipos de Empresa
    Route::get('gestion_empresas', [TipoEmpresaController::class, 'index'])->name('tipos-empresa.index');
    Route::post('gestion_empresas', [TipoEmpresaController::class, 'store'])->name('tipos-empresa.store');
    Route::put('gestion_empresas/{id}', [TipoEmpresaController::class, 'update'])->name('tipos-empresa.update');
    Route::delete('gestion_empresas/{id}', [TipoEmpresaController::class, 'destroy'])->name('tipos-empresa.destroy');

    // Gestión de Empresas
    Route::get('listado_empresas', [EmpresaController::class, 'index'])->name('empresas.index');
    Route::post('listado_empresas', [EmpresaController::class, 'store'])->name('empresas.store');
    Route::put('listado_empresas/{id}', [EmpresaController::class, 'update'])->name('empresas.update');
    Route::delete('listado_empresas/{id}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');

    // Gestión de Convenios
    Route::get('/listado_convenios', [ConveniosController::class, 'index'])->name('convenios.index');
    Route::post('/convenio_store', [ConveniosController::class, 'store'])->name('convenios.store');
    Route::get('/convenio_details/{id}', [ConveniosController::class, 'details'])->name('convenios.details');
    Route::post('/convenio_update', [ConveniosController::class, 'update'])->name('convenios.update');
    Route::post('/convenio_delete', [ConveniosController::class, 'destroy'])->name('convenios.delete');

    Route::post('/convenio_upload', [ConveniosController::class, 'upload'])->name('convenios.upload');
    Route::get('/convenio_download/{id}', [ConveniosController::class, 'download'])->name('convenios.download');

});
