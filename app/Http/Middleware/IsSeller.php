<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->rol === 'Administrador' || Auth::user()->rol === 'Vendedor')) {
            return $next($request);
        }

        // Redirigir o lanzar una excepción si el usuario no es administrador
        return redirect('/dashboard')->with('error', 'No tienes permisos para acceder a esta página');
    }
}