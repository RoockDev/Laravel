<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class CountTiles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $partidaId = $request->route('id');
        $posicion1 = $request->route('position1');
        $posicion2 = $request->route('position2');
        $casillas = DB::table('casilla')
            ->where('partida_id', $partidaId)
            ->whereIn('posicion', [$posicion1, $posicion2])
            ->where('estado', 'oculta')
            ->get();

        if ($casillas->count() != 2) {
            return response()->json(['error' => 'una o ambas casillas han sido ya resueltas']);
        }
        return $next($request);
    }
}
