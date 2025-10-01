<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;

Route::get('devolver-monedas/{cantidad}', [ServicioController::class,'devolverMonedas'])
->where('cantidad', '[0-9]+(\.[0-9]{1,2})?'); //permite maximo 2 decimales 
Route::get('calcular-edad/{fecha_nacimiento?}',[ServicioController::class, 'calcularEdad']);
Route::get('comparar-numero/{num1}/{num2}',[ServicioController::class, 'compararNumeros'])
->where('num1', '[0-9]+')
->where('num2','[0-9]+'); //permite solo numeros enteros positivos
