<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ValidarSocio;
use App\Livewire\InscripcionEtapa1;

use App\Livewire\Admin\GestionarConvocatoria;
use App\Livewire\Admin\RevisarProyecto;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('/validar-socio', ValidarSocio::class)
    ->name('validar-socio');

Route::get('/inscripcion/etapa-1', InscripcionEtapa1::class)
    ->name('inscripcion.etapa1');


Route::get('/dashboard/convocatoria/{convocatoria}', GestionarConvocatoria::class)
    ->middleware(['auth', 'verified'])
    ->name('convocatoria.gestionar');

Route::get('/admin/proyectos/{proyecto}/revisar', RevisarProyecto::class)
    ->name('proyecto.revisar');



require __DIR__ . '/auth.php';
