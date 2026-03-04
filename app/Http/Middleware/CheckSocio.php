<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSocio
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Si no está autenticado, siempre al login (validar-socio)
        if (!Auth::check()) {
            return redirect()->route('validar-socio');
        }

        $user = Auth::user();

        // 2. LÓGICA PARA ADMINISTRADORES
        if ($user->tipo_socio === 'Administrador') {
            // CRÍTICO: Si YA ESTÁ intentando entrar a una ruta de admin, déjalo pasar (next)
            // Si no hacemos esto, se queda en un bucle infinito redirigiendo a admin.dashboard
            if ($request->is('admin*')) {
                return $next($request);
            }

            // Si es admin pero intentó entrar a una ruta de socio (como /mi-panel), 
            // entonces sí lo mandamos a su panel administrativo.
            return redirect()->route('admin.dashboard');
        }

        // 3. LÓGICA PARA SOCIOS
        // Si un socio normal intentara entrar a /admin (por error de URL), lo mandamos a su panel
        if ($request->is('admin*')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}