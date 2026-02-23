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
        // 1. Definir a dónde enviar a los que NO tienen sesión
        $middleware->redirectGuestsTo(fn() => route('validar-socio'));

        // 2. Tu alias actual
        $middleware->alias([
            'check.socio' => \App\Http\Middleware\CheckSocio::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
