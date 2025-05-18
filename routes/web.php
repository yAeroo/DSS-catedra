<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('gestion_empresas', function () {
    return view('gestion_empresas');
});

Route::get('listado_convenios', function () {
    return view('listado_convenios');
});
