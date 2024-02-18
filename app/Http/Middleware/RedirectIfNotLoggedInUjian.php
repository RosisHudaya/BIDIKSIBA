<?php

namespace App\Http\Middleware;

use App\Models\AkunUjian;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotLoggedInUjian
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
        if (!$request->session()->has('login_ujian')) {
            return redirect('login-ujian')->with('error', 'Login terlebih dahulu untuk mengakses halaman ujian.');
        }
        return $next($request);
    }
}
