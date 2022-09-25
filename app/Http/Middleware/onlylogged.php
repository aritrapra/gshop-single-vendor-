<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Session;

class onlylogged
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
            $user_hash = session()->get('myid');
            $session = Session::where('key_id','=',$user_hash)->first(['hash']);
            $user = Crypt::decrypt($session->hash);

            $user_data = User::where(DB::raw('BINARY `name`'), $user)->count();
            if($user_data != 1){

                return redirect('/login');
            }else{
                return $next($request);
            }
        } catch (\Throwable $th) {
            return redirect('/login');
        }

    }
}
