<?php

use App\Http\Controllers\MiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//GET obtener todos los usuarios
Route::get('/listar',[MiController::class,'getAllUsers']);
//GET obtener usuario especifico
Route::get('/usuarios/{dni}', [MiController::class, 'getUserByDni']);
//POST obtener usuario especifico
Route::post('/usuario',[MiController::class,'createUser']);
//PUT actualizar usuario completo
Route::put('/usuario/{dni}',[MiController::class,'updateUser']);
//PATCH actualizar usuarios por cachos
Route::patch('/usuario/{dni}',[MiController::class,'updateUserByDniPatch']);
//DELETE eliminar usuario
Route::delete('/usuario/{dni}',[MiController::class,'deleteUser']);
