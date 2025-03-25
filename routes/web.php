<?php

use App\Http\Controllers\citatorioController;
use App\Http\Controllers\citatorioGeneralClaseController;
use App\Http\Controllers\expedienteDisciplinarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\expedienteMedicoController;
use App\Http\Controllers\controlDeCitaController;
use App\Http\Controllers\justificanteMedicoController;
use App\Http\Controllers\informeSaludController;
use App\Http\Controllers\justiRetardoSocialeController;
use App\Http\Controllers\paseSalidaController;
use App\Http\Controllers\paseSalidaTrabSocialeController;
use App\Http\Controllers\permisoTrabSocialeController;
use App\Http\Controllers\reporteIncidenciaController;
use App\Http\Controllers\suspencioClaseController;

Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');

//Rutas medicas
Route::resource('expedientes_medicos', expedienteMedicoController::class);
Route::resource('control_de_citas', controlDeCitaController::class);
Route::resource('justificante_inasistencia_medico', justificanteMedicoController::class);
Route::resource('informe_salud', informeSaludController::class);

//Rutas disciplinarias
Route::resource('expediente_disciplinario', expedienteDisciplinarioController::class);
Route::resource('citatorio', citatorioController::class);
Route::resource('citatorio_general', citatorioGeneralClaseController::class);
Route::resource('pase_salida', paseSalidaController::class);
Route::resource('reporte_incidencia', reporteIncidenciaController::class);
Route::resource('suspencion_clase', suspencioClaseController::class);


//Rutas trabajo social
Route::resource('pase_salida_trab_sociale', paseSalidaTrabSocialeController::class);
Route::resource('permiso_trab_sociale', permisoTrabSocialeController::class);
Route::resource('justi_retardo_sociale', justiRetardoSocialeController::class);


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
