<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminsecure
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
        $string = "Cheaked Admin Goodiesetuser GodiesetPass2021";
        if (hash('sha256',$string) == session()->get('adminuser')) {
            return $next($request);
        }else {
            return redirect('/404error');
        }

    }
}
