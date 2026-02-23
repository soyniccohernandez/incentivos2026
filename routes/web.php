<?php

use Illuminate\Support\Facades\Route;

// Namespaces de los componentes
use App\Livewire\Sitio\{ValidarSocio, InscripcionEtapa1, InscripcionEtapa2, SubsanarEtapaUno, Inscritos, RetroalimentacionProyecto};
use App\Livewire\Admin\{AdminDashboard, Convocatorias\Index as ConvocatoriasIndex, Convocatorias\Gestionar as ConvocatoriasGestionar, Convocatorias\RevisarProyecto, ConvocatoriaConfig};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. RUTAS PÚBLICAS ---
Route::view('/', 'welcome');
Route::get('/proyectos-inscritos', Inscritos::class)->name('inscritos.publico');

Route::get('/keep-alive', function () {
    return response()->json(['status' => 'alive']);
});

// --- 2. PORTAL DEL SOCIO (Flujo de Inscripción) ---
Route::prefix('convocatoria')->group(function () {

    // RUTA DE ACCESO: Pública para login
    Route::get('/validar/{proyecto?}', ValidarSocio::class)->name('validar-socio');

    // RUTAS PROTEGIDAS PARA SOCIOS
    Route::middleware(['auth', 'check.socio'])->group(function () {
        
        /**
         * IMPORTANTE: Nombramos esta ruta como 'dashboard' para que el 
         * login de socios funcione con el redireccionamiento estándar.
         */
        Route::get('/registro-etapa-1', InscripcionEtapa1::class)->name('dashboard');

        Route::get('/proyecto/{proyectoId}/documentacion', InscripcionEtapa2::class)->name('inscripcion.etapa2');

        Route::get('/proyecto/{proyecto}/subsanar', SubsanarEtapaUno::class)->name('subsanar-etapa-1');

        Route::get('/proyecto/{proyecto}/retroalimentacion', RetroalimentacionProyecto::class)
            ->name('proyecto.retroalimentacion');
    });
});

// --- 3. PANEL ADMINISTRATIVO ---
/**
 * IMPORTANTE: El prefijo es 'admin' y el nombre de la ruta principal 
 * es 'admin.dashboard' para que coincida con tu lógica de Login.
 */
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Esta es la ruta a la que llegará el usuario si es 'Administrador'
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    
    Route::view('/perfil', 'profile')->name('profile');

    Route::prefix('gestion')->group(function () {
        Route::get('/convocatorias', ConvocatoriasIndex::class)->name('admin.convocatorias.index');
        Route::get('/convocatoria/{convocatoria}/proyectos', ConvocatoriasGestionar::class)->name('convocatoria.gestionar');
        Route::get('/proyecto/{proyecto}/revisar', RevisarProyecto::class)->name('proyecto.revisar');
        Route::get('/convocatoria/{id}/config', ConvocatoriaConfig::class)->name('admin.convocatorias.config');
    });
});

// Rutas de autenticación (Breeze/Volt)
require __DIR__ . '/auth.php';