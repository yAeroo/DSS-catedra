<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoEmpresaController;

//Index
Route::get('/', function () {
    return view('index');
});

//Gestion de Empresas
Route::get('gestion_empresas', [TipoEmpresaController::class, 'index'])->name('tipos-empresa.index');

//Create Tipo de Empresa (store)
Route::post('gestion_empresas', [TipoEmpresaController::class, 'store'])->name('tipos-empresa.store');

// Update Tipo de Empresa
Route::put('gestion_empresas/{id}', [TipoEmpresaController::class, 'update'])->name('tipos-empresa.update');

// Delete Tipo de Empresa
Route::delete('gestion_empresas/{id}', [TipoEmpresaController::class, 'destroy'])->name('tipos-empresa.destroy');

//Gestion de Convenios
Route::get('listado_convenios', function () {
    return view('listado_convenios');
});
