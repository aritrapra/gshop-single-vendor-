<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Profile;
use Closure;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CheakUser
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
        $cats = DB::table('catagories')->get();
        try {
            $key = session()->get('key');
            $user_hash = session()->get('myid');
            $session = Session::where('key_id','=',$user_hash)->first(['hash']);
            $user = Crypt::decrypt($session->hash);

            $user_data = User::where(DB::raw('BINARY `name`'), $user)->first(['two_factor','pgp']);

            if($user_data != null){
                $string = hash('sha256','M_its'.$user);
                if($user_data->two_factor == '1'){
                    if($string == session()->get('key1')){
                        view()->share('user',$user);
                        view()->share('cats',$cats);
                        view()->share('userdata',$user_data);
                        return $next($request);
                    }else{
                        return redirect('/twofactorcheak');
                    }
                }else{
                    view()->share('user',$user);
                    view()->share('cats',$cats);
                    view()->share('userdata',$user_data);
                    return $next($request);
                }

            }else{
                return redirect('/login');
            }

        } catch (\Throwable $th) {
            view()->share('user',"Not_Set");
            view()->share('cats', $cats);
            return $next($request);
        }
    }
}
