<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicioController extends Controller
{
    function contarCaracter($cadena,$caracter){

         $cadena = strtolower($cadena);
         $caracter = strtolower($caracter);

         $contador = 0;
         for ($i=0; $i < strlen($cadena) ; $i++) { 
            if ($cadena[$i] === $caracter) {
                $contador++;
            }
         }

         return response()->json([
            'cadena' => $cadena,
            'caracter' => $caracter,
            'veces en cadena' => $contador
         ]);
    }

    function codificarCesar($mensaje){
        $mensaje = strtoupper($mensaje);

        $resultado = '';

        for ($i=0; $i < strlen($mensaje) ; $i++) { 
            $letra = $mensaje[$i];

            if ($letra >= 'A' && $letra <= 'Z') {
                if ($letra == 'Z') {
                    $resultado .= 'A';
                }else{
                    // ord convierte a ASCII , le sumamos uno y con chr convertimos de ASCII a caracter
                    $resultado .= chr(ord($letra) + 1); //siguiente letra
                }
            }else if($letra >= '0' && $letra <= '9'){
                if ($letra == '9') {
                    $resultado .= '0';
                }else{
                    $resultado .= chr(ord($letra) + 1);
                }

            }else{
                $resultado .= $letra;
            }


        }

        return response()->json([
            'mensaje original' => $mensaje,
            'mensaje cesar' => $resultado
        ]);
    }

    function contarPalabras($frase){
        $palabras = explode(' ',$frase);

        $contador = 0;
        foreach ($palabras as $palabra) {
            if (trim($palabra) != '') {
                $contador++;
            }
        }

        return response()->json([
            'frase' => $frase,
            'palabras' => $contador
        ]);

    }

    function esPalindromo($cadena){
        // quitamos espacios en blanco y convertimos a minusculas
        $cadenaLimpia = strtolower(str_replace(' ','',$cadena));
        $resultado = '';

        //con strrev miramos si es igual alreves
        $reversa = strrev($cadenaLimpia);

        if ($cadenaLimpia == $reversa) {
            $resultado = 'Es un palindromo';
        }else{
            $resultado = 'No es un palindromo';
        }

        return response()->json([
            'cadena' => $cadena,
            'resultado' => $resultado

        ]);
    }


    function sonAnagramas($cad1,$cad2){
        //quitamos espacios y minusculas
        $cad1 = strtolower(str_replace(' ','',$cad1));
        $cad2 = strtolower(str_replace(' ','',$cad2));

        //convertimos las cadenas a un array para tener las letas separadas
        $letras1 = str_split($cad1);
        $letras2 = str_split($cad2);

        //ordenamos las letras para poder compararlas luego
        sort($letras1);
        sort($letras2);

        //convertimos otra vez a texto para comparar
        $ordenadas1 = implode('',$letras1);
        $ordenadas2 = implode('',$letras2);

        $resultado = '';
        if ($ordenadas1 == $ordenadas2) {
            $resultado = 'son anagramas';
        }else{
            $resultado = 'no son anagramas';
        }

        return response()->json([
            'cadena 1' => $cad1,
            'cadena 2' => $cad2,
            'resultado' => $resultado
        ]);
    }






}
