<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\expedienteMedicoController;
use App\Http\Controllers\controlDeCitaController;


Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');

//route::view('/expedientes_medicos', 'expediente_medico.index');
Route::resource('expedientes_medicos', expedienteMedicoController::class);

Route::resource('control_de_citas', controlDeCitaController::class);
/*
Route::get('/panel', function () {
    return view('panel.index');
});
*/
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