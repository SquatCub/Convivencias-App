<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UsuarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->usuario != null) {
            return $next($request);
        }
        return redirect()->route('logout');
    }
}
