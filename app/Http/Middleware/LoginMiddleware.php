<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->getRequestUri()=='/login'||session('auth') == true) {
            return $next($request);
        }
        return redirect(route('login'));
    }
}
