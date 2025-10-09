<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiferentPositions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $posicion1 = $request->route('position1');
        $posicion2 = $request->route('position2');
         if ($posicion1 === $posicion2) {
                return response()->json(['error' => 'debe introducir 2 casillas distintas']);
            }
        return $next($request);
    }
}
