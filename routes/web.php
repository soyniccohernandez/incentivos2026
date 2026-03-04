<?php

use Illuminate\Support\Facades\Route;

// Namespaces de los componentes del Sitio (Portal del Socio)
use App\Livewire\Sitio\{
    ValidarSocio, 
    DashboardSocio, 
    InscripcionEtapa1, 
    InscripcionEtapa2, 
    SubsanarEtapaUno, 
    Inscritos, 
    RetroalimentacionProyecto
};

use App\Livewire\Admin\Socios\Index as SociosIndex;

// Namespaces de los componentes Administrativos
use App\Livewire\Admin\{
    AdminDashboard, 
    Convocatorias\Index as ConvocatoriasIndex, 
    Convocatorias\Gestionar as ConvocatoriasGestionar, 
    Convocatorias\RevisarProyecto, 
    ConvocatoriaConfig
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. RUTAS PÚBLICAS ---
Route::view('/', 'welcome');
Route::view('/e', 'welcome_ex');
Route::get('/proyectos-inscritos', Inscritos::class)->name('inscritos.publico');

// Mantenimiento de sesión
Route::get('/keep-alive', function () {
    return response()->json(['status' => 'alive']);
});

// --- 2. PORTAL DEL SOCIO (Flujo Inteligente) ---
Route::prefix('convocatoria')->group(function () {

    // Acceso público para identificación
    Route::get('/validar/{proyecto?}', ValidarSocio::class)->name('validar-socio');

    // Rutas protegidas para Socios
    Route::middleware(['auth', 'check.socio'])->group(function () {
        
        // El DashboardSocio decide dinámicamente qué mostrar (Formulario o Estado)
        Route::get('/mi-panel', DashboardSocio::class)->name('dashboard');

        // Etapa 2: Documentación técnica y elenco
        Route::get('/proyecto/{proyectoId}/documentacion', InscripcionEtapa2::class)
            ->name('inscripcion.etapa2');

        // Subsanación Etapa 1
        Route::get('/proyecto/{proyecto}/subsanar', SubsanarEtapaUno::class)
            ->name('subsanar-etapa-1');

        // Resultados y Jurados
        Route::get('/proyecto/{proyecto}/retroalimentacion', RetroalimentacionProyecto::class)
            ->name('proyecto.retroalimentacion');
    });
});

// --- 3. PANEL ADMINISTRATIVO (Gestión Interna) ---
// SE ELIMINÓ 'verified' PARA EVITAR LA REDIRECCIÓN AL FORMULARIO DE CORREO
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Ruta raíz del administrador
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    
    Route::get('/admin/socios', SociosIndex::class)->name('admin.socios.index');
    
    // Perfil
    Route::view('/perfil', 'profile')->name('profile');

    // Gestión de convocatorias y revisión
    Route::prefix('gestion')->group(function () {
        Route::get('/convocatorias', ConvocatoriasIndex::class)->name('admin.convocatorias.index');
        
        Route::get('/convocatoria/{convocatoria}/proyectos', ConvocatoriasGestionar::class)
            ->name('convocatoria.gestionar');
            
        Route::get('/proyecto/{proyecto}/revisar', RevisarProyecto::class)
            ->name('proyecto.revisar');
            
        Route::get('/convocatoria/{id}/config', ConvocatoriaConfig::class)
            ->name('admin.convocatorias.config');
    });
});

// Rutas de autenticación (Breeze / Jetstream)
require __DIR__ . '/auth.php';