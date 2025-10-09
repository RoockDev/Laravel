<?php

use App\Http\Middleware\CountTiles;
use App\Http\Middleware\DiferentPositions;
use App\Http\Middleware\GameFound;
use App\Http\Middleware\SizeVerify;
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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'sizeVerify' =>SizeVerify::class,
            'diferentPositions' => DiferentPositions::class,
            'gameFound' => GameFound::class,
            'countTiles' => CountTiles::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
