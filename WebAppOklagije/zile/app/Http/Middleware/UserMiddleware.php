<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        if ($request->session()->has('korisnik'))
        {
            $user = $request->session()->get('korisnik');

            if ($user[0]->uloga == 2)
            {
                return $next($request);
            }
            else
            {
                return redirect()->back()->with('error', 'Nemate pravo pristupa');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Nemate pravo pristupa');
        }
    }
}
