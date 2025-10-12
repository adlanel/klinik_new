<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Cek apakah user adalah admin atau super_admin
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'Akses ditolak. Halaman ini khusus untuk admin.');
        }

        return $next($request);
    }
}