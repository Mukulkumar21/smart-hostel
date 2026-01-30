<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    // 🔥 VERY IMPORTANT: Providers register karna (View, Blade, etc.)
    ->withProviders(require __DIR__.'/providers.php')

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        // ✅ TRUST ALL PROXIES (Vercel / Cloud safe)
        $middleware->trustProxies(at: '*');

    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
