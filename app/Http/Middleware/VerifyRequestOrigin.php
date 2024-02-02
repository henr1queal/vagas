<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyRequestOrigin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedOrigins = ['https://vagasmaceio.com.br', 'https://www.vagasmaceio.com.br']; // Adicione os domínios permitidos aqui

        if (in_array($request->header('Origin'), $allowedOrigins)) {
            return $next($request);
        }

        return response()->json(['error' => 'Acesso não autorizado.'], 403);
    }
}
