<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoEmpresaController;

//Index
Route::get('/', function () {
    return view('index');
});

//Gestion de Empresas
Route::get('gestion_empresas', [TipoEmpresaController::class, 'index'])->name('tipos-empresa.index');
/* Route::get('gestion_empresas', function () {
    return view('gestion_empresas');
})->name('gestion_empresas'); */

//Create Tipo de Empresa (store)
Route::post('gestion_empresas', [TipoEmpresaController::class, 'store'])->name('tipos-empresa.store');


//Gestion de Convenios
Route::get('listado_convenios', function () {
    return view('listado_convenios');
});
