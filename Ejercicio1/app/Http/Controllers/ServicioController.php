<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;



class ServicioController extends Controller
{
    function devolverMonedas($cantidad)
    {

        if (!is_numeric($cantidad) || $cantidad < 0) {
            return response()->json(['error' => 'Cantidad Invalida'], 400);
        }

        $centimos = round($cantidad * 100);
        $monedas = [200, 100, 50, 20, 10, 5, 2, 1];
        $resultado = [];

        foreach ($monedas as $valor) {
            if ($centimos >= $valor) {
                $cant = intdiv($centimos, $valor);

                if ($valor >= 100) {
                    $clave = ($valor / 100) . 'euros';
                } else {
                    $clave = $valor . 'centimos';
                }

                $resultado[$clave] = $cant;
                $centimos %= $valor;
            }
        }

        return response()->json([
            'cantidad_euros' => (float)$cantidad,
            'monedas_necesarias' => $resultado
        ]);
    }

    function calcularEdad($fechaNac = null)
    {
        

        if (!$fechaNac) {
            return response()->json([
                'fecha_nacmiento' => now()->format('Y-m-d'),
                'edad_calculada' => 0
            ]);
        }

        try {

            $fecha = Carbon::parse($fechaNac);
            //verificamos que la fecha no sea futura
            if ($fecha->isFuture()) {
                return response()->json([
                    'error' => 'la fecha no puede ser futura'
                ], 400);
            }

            //se calcula la edad automaticamente
            $edad = $fecha->age;
        } catch (\Exception $e) {
            return response()->json(['error' => 'introduce una fecha con el formato YYYY-MM-DD'], 400);
        }

        return response()->json([
            'fecha de nacimiento' => $fechaNac,
            'edad' => $edad
        ]);
    }

    function compararNumeros($num1,$num2){
        
        $sumarDigitos = function($numero){
            $suma = 0;
            //convierto el numero en strint y a la vez en un array para recorrer digito uno a uno
            foreach (str_split((string)$numero) as $digito) {
                $suma += $digito;
            }

            return $suma;
        };

        $sumaNum1 = $sumarDigitos($num1);
        $sumaNum2 = $sumarDigitos($num2);

        $ganador = 0;
        if ($sumaNum1 > $sumaNum2) {
            $ganador = $num1;
        }else if($sumaNum2 > $sumaNum1){
            $ganador = $num2;
        }else{
            $ganador = 'Empate';
        }

        return response()->json([
            'numero 1' => $num1,
            'numero 2' => $num2,
            'suma digitos numero 1' => $sumaNum1,
            'suma digitos numero 2' => $sumaNum2,
            'ganador' => $ganador
        ]);

    }
}
