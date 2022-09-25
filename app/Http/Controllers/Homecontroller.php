<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Data;

class Homecontroller extends Controller
{
    public function show_home(){
        $faqs = Faq::orderBy('created_at','desc')->get();
        return view('home',[
            'data' => $faqs
        ]);

    }
    public function showpgp(Request $request){
        $pgp = Data::where('type','=','pgp')->first('data');
        return view('pgp',[
            'pgp' => $pgp->data
        ]);
    }
}
