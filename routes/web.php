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
|
| Aquí se definen todas las rutas de la plataforma. El middleware 'auth' 
| garantiza la seguridad y 'check.socio' asegura que solo los socios activos
| accedan al flujo de inscripción.
|
*/

// --- 1. RUTAS PÚBLICAS ---
Route::view('/', 'welcome');
Route::view('/e', 'welcome_ex');
Route::get('/proyectos-inscritos', Inscritos::class)->name('inscritos.publico');

// Ruta técnica para mantener la sesión activa durante cargas largas de archivos
Route::get('/keep-alive', function () {
    return response()->json(['status' => 'alive']);
});

// --- 2. PORTAL DEL SOCIO (Flujo Inteligente) ---
Route::prefix('convocatoria')->group(function () {

    // RUTA DE ACCESO: Pública para que el socio se identifique o cree su password
    Route::get('/validar/{proyecto?}', ValidarSocio::class)->name('validar-socio');

    // RUTAS PROTEGIDAS PARA SOCIOS AUTENTICADOS
    Route::middleware(['auth', 'check.socio'])->group(function () {
        
        /**
         * DASHBOARD INTELIGENTE:
         * Esta es la ruta principal del socio ('dashboard').
         * El componente DashboardSocio decidirá qué mostrarle según su estado:
         * - Si no tiene proyecto -> Verá el formulario de Etapa 1.
         * - Si ya terminó -> Verá su estado de revisión.
         * - Si debe corregir -> Verá el aviso de subsanación.
         */
        Route::get('/mi-panel', DashboardSocio::class)->name('dashboard');

        // Etapa 2: Carga de documentación técnica y elenco (Solo si está habilitado)
        Route::get('/proyecto/{proyectoId}/documentacion', InscripcionEtapa2::class)
            ->name('inscripcion.etapa2');

        // Subsanación: Para corregir documentos de la Etapa 1
        Route::get('/proyecto/{proyecto}/subsanar', SubsanarEtapaUno::class)
            ->name('subsanar-etapa-1');

        // Retroalimentación: Resultados finales y comentarios de jurados
        Route::get('/proyecto/{proyecto}/retroalimentacion', RetroalimentacionProyecto::class)
            ->name('proyecto.retroalimentacion');
            
        // NOTA: La ruta antigua /registro-etapa-1 ya no es necesaria como ruta directa
        // porque el DashboardSocio cargará el componente dinámicamente.
    });
});

// --- 3. PANEL ADMINISTRATIVO (Gestión Interna) ---
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Ruta raíz del administrador
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    
    Route::get('/admin/socios', SociosIndex::class)->name('admin.socios.index');
    // Perfil de usuario administrativo
    Route::view('/perfil', 'profile')->name('profile');

    // Gestión de convocatorias y revisión de proyectos
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

// Rutas automáticas de autenticación (Breeze / Jetstream / Volt)
require __DIR__ . '/auth.php';