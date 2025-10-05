<?php

use App\Http\Controllers\MiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/partida',[MiController::class, 'crearPartida']);
Route::get('/partida/{id}',[MiController::class, 'mostrarTablero']);
Route::post('/partida/{id}/comparar',[MiController::class,'compararCasillas']);
Route::post('/partida/{id}/ocultar',[MiController::class,'ocultarCasillas']);
Route::get('/partida/{id}/mostrarSolucion',[MiController::class,'mostrarSolucion']);