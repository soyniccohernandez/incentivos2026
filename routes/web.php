<?php

use Illuminate\Support\Facades\Route;

// Namespaces
use App\Livewire\Sitio\{ValidarSocio, InscripcionEtapa1, InscripcionEtapa2, SubsanarEtapaUno, Inscritos};
use App\Livewire\Admin\{AdminDashboard, Convocatorias\Index as ConvocatoriasIndex, Convocatorias\Gestionar as ConvocatoriasGestionar, Convocatorias\RevisarProyecto};

// --- 1. RUTAS PÚBLICAS ---
Route::view('/', 'welcome');
Route::get('/proyectos-inscritos', Inscritos::class)->name('inscritos.publico');

// --- 2. PORTAL DEL SOCIO (Flujo de Inscripción) ---
Route::prefix('convocatoria')->group(function () {

    // Ruta pública para validarse
    Route::get('/validar/{proyecto?}', ValidarSocio::class)->name('validar-socio');

    // Rutas protegidas por tu nuevo portero
    Route::middleware(['check.socio'])->group(function () {

        Route::get('/registro-etapa-1', InscripcionEtapa1::class)->name('inscripcion.etapa1');

        Route::get('/proyecto/{proyectoId}/documentacion', InscripcionEtapa2::class)->name('inscripcion.etapa2');

        Route::get('/proyecto/{proyecto}/subsanar', SubsanarEtapaUno::class)->name('subsanar-etapa-1');
    });
});

Route::get('/keep-alive', function () {
    return response()->json(['status' => 'alive']);
});


// --- 3. PANEL ADMINISTRATIVO ---
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Nombres originales para el Admin
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::view('/perfil', 'profile')->name('profile');

    Route::prefix('gestion')->group(function () {
        Route::get('/convocatorias', ConvocatoriasIndex::class)->name('admin.convocatorias.index');
        Route::get('/convocatoria/{convocatoria}/proyectos', ConvocatoriasGestionar::class)->name('convocatoria.gestionar');
        Route::get('/proyecto/{proyecto}/revisar', RevisarProyecto::class)->name('proyecto.revisar');

        // Metemos la configuración aquí dentro
        Route::get('/convocatoria/{id}/config', \App\Livewire\Admin\ConvocatoriaConfig::class)
            ->name('admin.convocatorias.config');
    });
});

require __DIR__ . '/auth.php';
