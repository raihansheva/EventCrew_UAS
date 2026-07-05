<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class cekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {

            abort(403, 'Silakan login terlebih dahulu.');
        }

        if (!in_array(Auth::user()->role, $roles)) {

            abort(403, 'Anda tidak memiliki hak akses.');
        }

        return $next($request);
    }
}
