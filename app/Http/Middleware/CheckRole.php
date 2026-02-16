<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
{
    // Cek apakah user sudah login DAN apakah rolenya sesuai dengan yang diminta route
    if (!auth()->check() || auth()->user()->role !== $role) {
        // Jika tidak sesuai, lempar ke halaman 403 (Forbidden)
        abort(403, 'Hanya Admin yang boleh melakukan aksi ini!');
    }
    
    return $next($request);
}
}