<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSocio
{
    public function handle(Request $request, Closure $next)
    {
        // Si es la ruta de validar, ignorar
        if ($request->routeIs('validar-socio')) {
            return $next($request);
        }

        // Si no está autenticado, redirigir
        if (!Auth::check()) {
            return redirect()->route('validar-socio');
        }

        return $next($request);
    }
}