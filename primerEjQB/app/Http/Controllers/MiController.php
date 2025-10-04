<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiController extends Controller
{
    //GET  obtener los usuarios
    public function getAllUsers()
    {
        try {
            $personas = DB::table('personas')->get();
            
            if ($personas->isEmpty()) {
                return response()->json(['mensaje' => 'No hay usuarios registrados']);
            }
            
            return response()->json($personas);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener los usuarios']);
        }
    }

    //GET  obtener usuario por dni
    public function getUserByDni($dni)
    {
        try {
            $user = DB::table('personas')->where('dni', $dni)->first();
            
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado']);
            }
            
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al buscar el usuario']);
        }
    }

    //POST  crear usuario
    public function createUser(Request $request)
    {
        try {
            
            $exists = DB::table('personas')->where('dni', $request->dni)->exists();
            if ($exists) {
                return response()->json(['error' => 'ese dni existe ya']);
            }

            $registro = DB::table('personas')->insert([
                'dni' => $request->dni,
                'nombre' => $request->nombre,
                'tfno' => $request->tfno,
                'edad' => $request->edad
            ]);

            if ($registro) {
                return response()->json(['exito' => 'Usuario creado correctamente']);
            }
            
            return response()->json(['error' => 'No se puede crear el usuario']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear el usuario']);
        }
    }

    //PUT  actualizar usuario entero
    public function updateUser(Request $request, $dni)
    {
        try {
            $filasAfectadas = DB::table('personas')->where('dni', $dni)->update([
                'nombre' => $request->nombre,
                'tfno' => $request->tfno,
                'edad' => $request->edad
            ]);

            if ($filasAfectadas > 0) {
                return response()->json(['exito' => 'Usuario actualizado correctamente']);
            }
            
            return response()->json(['error' => 'Usuario no encontrado']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario']);
        }
    }

    //PATCH  actualizar el usuario en partes que queramos
    public function updateUserByDniPatch(Request $request, $dni)
    {
        try {
            $datoParaUpdatear = [];

            
            if ($request->has('nombre')) {
                $datoParaUpdatear['nombre'] = $request->nombre;
            }
            if ($request->has('tfno')) {
                $datoParaUpdatear['tfno'] = $request->tfno;
            }
            if ($request->has('edad')) {
                $datoParaUpdatear['edad'] = $request->edad;
            }

            if (empty($datoParaUpdatear)) {
                return response()->json(['error' => 'No hay datos para actualizar']);
            }

            $filasAfectadas = DB::table('personas')->where('dni', $dni)->update($datoParaUpdatear);
            
            if ($filasAfectadas > 0) {
                return response()->json(['exito' => 'Usuario actualizado correctamente']);
            }
            
            return response()->json(['error' => 'Usuario no encontrado']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario']);
        }
    }

    //DELETE  eliminar usuario
    public function deleteUser($dni) 
    {
        try {
            $filasAfectadas = DB::table('personas')->where('dni', $dni)->delete();

            if ($filasAfectadas > 0) {
                return response()->json(['exito' => 'Usuario eliminado correctamente']);
            }
            
            return response()->json(['error' => 'Usuario no encontrado']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario']);
        }
    }
}
