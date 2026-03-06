<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // Importante añadir esta línea

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Esta es la parte que hace la magia con Hostinger
Schedule::command('queue:work --stop-when-empty')
    ->everyMinute()
    ->withoutOverlapping();