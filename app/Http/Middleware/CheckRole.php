<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$hak_akses)
    {
        if (Auth::user()->hak_akses != $hak_akses) {
            return redirect()->route('home')->with('error','Anda Tidak Memiliki Akses Untuk Menggunakan Fitur Ini');
        }
        return $next($request);
    }
}
