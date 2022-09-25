<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Support_controller extends Controller
{
    public function show_support(Request $request){
        return view('support',[
            'data' => 'aa'
        ]);
    }
    public function create(Request $request){
        $request->validate([
            'reason' => 'required',

            'message' => 'required|min:10|max:1000'
        ]);
        try {
            #$key = session()->get('key');
            $user_hash = session()->get('myid');
            $session = Session::where('key_id','=',$user_hash)->first(['hash']);
            $user = Crypt::decrypt($session->hash);
            $support = new Support;
            $support->id = rand(10000000,9999999999);
            $support->user = $user;
            $support->reason = $request->reason;
            $support->message = $request->message;
            $support->save();
            return redirect()->back()->withErrors(['submited' => 'Forespørsel til support er nå sendt']);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
