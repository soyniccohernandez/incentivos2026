<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ValidarSocio;
use App\Livewire\InscripcionEtapa1;

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



require __DIR__ . '/auth.php';
