<?php

use App\Http\Controllers\roleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\userController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\citatorioController;
use App\Http\Controllers\paseSalidaController;
use App\Http\Controllers\informeSaludController;
use App\Http\Controllers\controlDeCitaController;
use App\Http\Controllers\suspencioClaseController;
use App\Http\Controllers\expedienteMedicoController;
use App\Http\Controllers\reporteIncidenciaController;
use App\Http\Controllers\justificanteMedicoController;
use App\Http\Controllers\permisoTrabSocialeController;
use App\Http\Controllers\justiRetardoSocialeController;
use App\Http\Controllers\citatorioGeneralClaseController;
use App\Http\Controllers\paseSalidaTrabSocialeController;
use App\Http\Controllers\expedienteDisciplinarioController;
use App\Http\Controllers\profileController;

Route::get('/panel', [homeController::class, 'index'])->name('panel');
//Route::view('/panel', 'panel.index') ->name('panel');
Route::get('/', function () {return redirect()->route('login'); });


Route::resources([
    'expedientes_medicos' => expedienteMedicoController::class,
    'control_de_citas' => controlDeCitaController::class,
    'justificante_inasistencia_medico' => justificanteMedicoController::class,
    'informe_salud' => informeSaludController::class,
    'expediente_disciplinario' => expedienteDisciplinarioController::class,
    'citatorio' => citatorioController::class,
    'citatorio_general' => citatorioGeneralClaseController::class,
    'pase_salida' => paseSalidaController::class,
    'reporte_incidencia' => reporteIncidenciaController::class,
    'suspencion_clase' => suspencioClaseController::class,
    'pase_salida_trab_sociale' => paseSalidaTrabSocialeController::class,
    'permiso_trab_sociale' => permisoTrabSocialeController::class,
    'justi_retardo_sociale' => justiRetardoSocialeController::class,
    'users' => userController::class,
    'roles' => roleController::class,
    'profile' => profileController::class,
]);

Route::get('/login', [loginController::class,'index'])->name('login');
Route::post('/login',[loginController::class, 'login']);
Route::get('/logout', [logoutController::class, 'logout'])->name('logout');


Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});
