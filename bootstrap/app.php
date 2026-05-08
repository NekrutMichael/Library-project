<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Дозволяємо Sanctum працювати зі станом (куками)
        $middleware->statefulApi();

        // 2. Вимикаємо перевірку CSRF для входу та реєстрації на час розробки
        $middleware->validateCsrfTokens(except: [
            'login',
            'register',
            'logout',
            'sanctum/csrf-cookie',
            'api/*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();