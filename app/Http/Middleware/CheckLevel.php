<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$levels
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // Jika tidak ada level yang ditentukan, lanjutkan request
        if (empty($levels)) {
            return $next($request);
        }

        // Periksa apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Pastikan user memiliki property level
        $userLevel = auth()->user()->level ?? null;

        if ($userLevel === null) {
            abort(403, 'User tidak memiliki level yang ditentukan.');
        }

        // Periksa level user
        if (in_array($userLevel, $levels)) {
            return $next($request);
        }

        // Jika tidak memiliki akses
        abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}