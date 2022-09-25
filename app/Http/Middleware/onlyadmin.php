<?php

namespace App\Http\Middleware;
use App\Models\Session;
use Illuminate\Support\Facades\Crypt;
use Closure;
use Illuminate\Http\Request;

class onlyadmin
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
        try {
            $key = session()->get('key');
            $user_hash = session()->get('myid');
            $session = Session::where('key_id','=',$user_hash)->first(['hash']);
            $user = Crypt::decrypt($session->hash);
            if ($user == "GodisHuset" or $user == "godisHusetmyadmin") {
                return $next($request);
            }else{
                return redirect('/404error');
            }
        } catch (\Throwable $th) {
            return redirect('/404error');
        }

    }
}
