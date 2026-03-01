<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan rolenya admin
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // Kalau bukan admin, tolak dan redirect ke halaman utama
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}