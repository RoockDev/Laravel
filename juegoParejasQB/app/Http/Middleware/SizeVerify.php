<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SizeVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tamano = $request->input('tamano');
                if (!($tamano % 2 == 0)) {
            return response()->json(['error' => 'el tamaño tiene que ser un numero par']);
        }
        return $next($request);
    }
}
