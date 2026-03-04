<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 1. Redirigir invitados al acceso de socio
        $middleware->redirectGuestsTo(fn() => route('validar-socio'));

        // 2. Redirigir usuarios ya autenticados a su panel principal
        $middleware->redirectUsersTo(fn() => route('dashboard'));

        // 3. Configuración de Alias
        $middleware->alias([
            'check.socio' => \App\Http\Middleware\CheckSocio::class,

            // SOBREESCRITURA TÉCNICA: 
            // Reemplazamos el middleware de verificación original por el tuyo.
            // Esto anula cualquier intento de Laravel de pedir confirmación de email.
            'verified' => \App\Http\Middleware\CheckSocio::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
