<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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

            if ($user[0]->uloga == 1)
            {
                return $next($request);
            }
            else
            {
                return redirect('/')->with('error', 'Niste prijavljeni ili nemate pravo pristupa');
            }
        }
        else
        {
            return redirect('/')->with('error', 'Niste prijavljeni');
        }
    }
}
