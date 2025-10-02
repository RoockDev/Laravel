<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;

//contar repeticion de caracter
Route::get('contar-caracter/{cadena}/{caracter}',[ServicioController::class, 'contarCaracter']);

//La clave Cesar
Route::get('codificar-cesar/{mensaje}',[ServicioController::class,'codificarCesar']);

//contar cuantas palabras tiene
Route::get('contar-palabras/{frase}',[ServicioController::class,'contarPalabras']);

//Es palindromo
Route::get('es-palindromo/{cadena}',[ServicioController::class, 'esPalindromo']);

//anagrama
Route::get('son-anagramas/{cad1}/{cad2}',[ServicioController::class, 'sonAnagramas']);
