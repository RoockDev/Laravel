<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiController extends Controller
{
    public function crearPartida(Request $request)
    {
        $tamano = $request->input('tamano');



        //con insertGetId insertas y recuperas el id ya que funciona con las tablas que tienen autoincremente
        $partidaId = DB::table('partida')->insertGetId([
            'tamano' => $tamano
        ]);

        //generamos el tablero con las parejas
        $parejas = [];
        $cantidadParejas = $tamano / 2;
        for ($i = 1; $i <= $cantidadParejas; $i++) {
            $parejas[] = $i;
            $parejas[] = $i;
        }

        shuffle($parejas);

        $casillas = [];

        foreach ($parejas as $posicion => $valor) {
            $casillas[] = [
                'partida_id' => $partidaId,
                'posicion' => $posicion,
                'valor' => $valor,
                'estado' => 'oculta'
            ];
        }

        DB::table('casilla')->insert($casillas); //laravel detecta que es un array y hace un insert multiple

        return response()->json([
            'mensaje' => 'partida creada correctamente',
            'partida_id' => $partidaId,
            'tamano' => $tamano
        ]);
    }

    public function mostrarTablero($id)
    {
        try {
            $partida = DB::table('partida')->where('id', $id)->first();
            
            $casillas = DB::table('casilla')
                ->where('partida_id', $id)
                ->orderBy('posicion')
                ->get();

            $tablero = [];
            foreach ($casillas as $casilla) {
                $tablero[] = [
                    'posicion' => $casilla->posicion,
                    'estado' => $casilla->estado,
                    'valor' => ($casilla->estado === 'visible' || $casilla->estado === 'encontrada') ? $casilla->valor : null
                ];
            }

            return response()->json([
                'partida_id' => $id,
                'tamano' => $partida->tamano,
                'tablero' => $tablero
            ]);
        } catch (Exception) {
            return response()->json(['error' => 'no se pudo obtener informacion del tablero']);
        }
    }

    public function mostrarSolucion($id){
        try {
            $partida = DB::table('partida')->where('id',$id)->first();
            
            $casillas = DB::table('casilla')
            ->where('partida_id',$id)
            ->orderBy('posicion')
            ->get();

            $tablero = [];
            foreach ($casillas as $casilla) {
                $tablero[] = [
                    'posicion' => $casilla->posicion,
                    'estado' => $casilla->estado,
                    'valor' => $casilla->valor
                ];
            }

            return response()->json([
                'partida' => $id,
                'tamano' => $partida->tamano,
                'tablero' => $tablero
            ]);


        } catch (Exception $e) {
            return response()->json(['error' => 'error al mostrar la solucion']);
        }

    }

    public function compararCasillas(Request $request, $partidaId)
    {
        try {
            $posicion1 = $request->input('posicion1');
            $posicion2 = $request->input('posicion2');

            //obtenemos las dos casillas con whereIn que es una maravilla
            $casillas = DB::table('casilla')
                ->where('partida_id', $partidaId)
                ->whereIn('posicion', [$posicion1, $posicion2])
                ->where('estado', 'oculta')
                ->get();

            

            $casilla1 = $casillas->where('posicion', $posicion1)->first();
            $casilla2 = $casillas->where('posicion', $posicion2)->first();

            //las ponemos visibles temporalmente, si al final no son pareja las ocultamos de nuevo
            DB::table('casilla')
                ->where('partida_id', $partidaId)
                ->whereIn('posicion', [$posicion1, $posicion2])
                ->update(['estado' => 'visible']);

            $esPareja = $casilla1->valor === $casilla2->valor;

            if ($esPareja) {
                DB::table('casilla')
                    ->where('partida_id', $partidaId)
                    ->whereIn('posicion', [$posicion1, $posicion2])
                    ->update(['estado' => 'encontrada']);
            }

            return response()->json([
                'pareja' => $esPareja,
                'casilla 1' => [
                    'posicion' => $casilla1->posicion,
                    'valor' => $casilla1->valor
                ],
                'casilla 2' => [
                    'posicion' => $casilla2->posicion,
                    'valor' => $casilla2->valor
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'error al comparar las parejas'], 500);
        }
    }

    public function ocultarCasillas(Request $request, $partidaId)
    {

        try {
            $posicion1 = $request->input('posicion1');
            $posicion2 = $request->input('posicion2');

            $ocultacion = DB::table('casilla')
                ->where('partida_id', $partidaId)
                ->whereIn('posicion', [$posicion1, $posicion2])
                ->update(['estado' => 'oculta']);

            return response()->json(['mensaje' => 'casillas ocultadas']);
        } catch (Exception $e) {
            return response()->json(['error' => 'error al ocultar las casillas']);
        }
    }
}
