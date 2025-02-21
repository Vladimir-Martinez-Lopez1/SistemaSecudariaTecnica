<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\expedienteMedicoController;
use App\Http\Controllers\controlDeCitaController;
use App\Http\Controllers\justificanteMedicoController;
use App\Http\Controllers\informeSaludController;


Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');


Route::resource('expedientes_medicos', expedienteMedicoController::class);
Route::resource('control_de_citas', controlDeCitaController::class);
Route::resource('justificante_inasistencia_medico', justificanteMedicoController::class);
Route::resource('informe_salud', informeSaludController::class);

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});