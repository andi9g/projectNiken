<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GerbangLogin
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
        if ($request->session()->get('login') === true && $request->session()->get('posisi')==="admin") {
            return $next($request);
        }else {
            return redirect('/')->with('toast_error', 'Silahkan Login');
        }
    }
}
