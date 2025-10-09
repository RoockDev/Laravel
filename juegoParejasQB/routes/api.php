<?php

use App\Http\Controllers\MiController;
use App\Http\Middleware\CountTiles;
use App\Http\Middleware\DiferentPositions;
use App\Http\Middleware\GameFound;
use App\Http\Middleware\RequirePositions;
use App\Http\Middleware\SizeVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/partida',[MiController::class, 'crearPartida'])->middleware('sizeVerify');
Route::get('/partida/{id}',[MiController::class, 'mostrarTablero'])->middleware(GameFound::class);
Route::post('/partida/{id}/{position1}/{position2}/comparar',[MiController::class,'compararCasillas'])->middleware('diferentPositions')->middleware('gameFound')->middleware('countTiles');
Route::post('/partida/{id}/ocultar',[MiController::class,'ocultarCasillas']);
Route::get('/partida/{id}/mostrarSolucion',[MiController::class,'mostrarSolucion'])->middleware(GameFound::class);