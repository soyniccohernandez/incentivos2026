<?php

use Illuminate\Support\Facades\Route;

// 1. Componentes Parte Pública (Sitio)
use App\Livewire\Sitio\ValidarSocio;
use App\Livewire\Sitio\InscripcionEtapa1;

// 2. Componentes Administrativos (Módulo Convocatorias)
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\Convocatorias\Index as ConvocatoriasIndex;
use App\Livewire\Admin\Convocatorias\Gestionar as ConvocatoriasGestionar;
use App\Livewire\Admin\Convocatorias\RevisarProyecto;
use App\Livewire\Sitio\Inscritos;
use App\Livewire\Sitio\InscripcionEtapa2;

// --- RUTAS PÚBLICAS ---
Route::view('/', 'welcome');

// Módulo de Inscripciones para Socios
Route::prefix('inscripcion')->group(function () {
    Route::get('/validar', ValidarSocio::class)
        ->name('validar-socio');

    Route::get('/etapa-1', InscripcionEtapa1::class)
        ->name('inscripcion.etapa1');
});

Route::get('/proyectos-inscritos', Inscritos::class)->name('inscritos.publico');


// --- RUTAS ADMINISTRATIVAS (Protegidas) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Principal (Menú de Cards)
    Route::get('dashboard', AdminDashboard::class)
        ->name('dashboard');

    // Perfil de Usuario
    Route::view('profile', 'profile')
        ->name('profile');

    // Módulo de Gestión de Convocatorias
    Route::prefix('admin/convocatorias')->group(function () {

        // 1. Listado principal de convocatorias
        Route::get('/', ConvocatoriasIndex::class)
            ->name('admin.convocatorias.index');

        // 2. Gestión de proyectos dentro de una convocatoria específica
        Route::get('/{convocatoria}/gestionar', ConvocatoriasGestionar::class)
            ->name('convocatoria.gestionar');

        // 3. Revisión detallada de un proyecto individual
        Route::get('/proyectos/{proyecto}/revisar', RevisarProyecto::class)
            ->name('proyecto.revisar');
    });

    // Futuros módulos:
    // Route::prefix('admin/socios')...

    Route::get('/inscripcion/etapa-2/{proyectoId}', InscripcionEtapa2::class)
        ->name('inscripcion.etapa2')
        ->middleware(['auth', 'check.socio']); // O el middleware que uses para validar al socio
});



require __DIR__ . '/auth.php';
