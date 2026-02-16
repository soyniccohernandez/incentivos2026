<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSocio
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. REGLA: ¿El socio tiene la sesión activa?
        // Buscamos la variable 'socio_id' que debiste crear al validar el formulario inicial
        if (!session()->has('socio_id')) {
            
            // Si NO tiene la sesión, lo mandamos de patitas a la calle (al formulario de validación)
            return redirect()->route('validar-socio')
                             ->with('error', 'Sesión expirada o no autorizada. Por favor valide sus datos.');
        }

        // 2. REGLA EXTRA (Seguridad Pro): 
        // Si la ruta trae un proyecto (ej: /proyecto/5/subsanar), revisamos que ese proyecto sea suyo
        $proyecto = $request->route('proyecto'); // Laravel atrapa el {proyecto} de la URL
        
        if ($proyecto && $proyecto->socio_id !== session('socio_id')) {
            // Si intenta entrar al proyecto de otro, lo bloqueamos
            abort(403, 'No tienes permiso para acceder a este proyecto.');
        }

        // Si pasó todas las reglas... ¡ADELANTE!
        return $next($request);
    }
}