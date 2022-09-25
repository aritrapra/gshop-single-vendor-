<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class Faq_controller extends Controller
{
    public function show_faq(Request $request){
        $allfaq = Faq::orderBy('created_at','desc')->get();
        return view('faq',[
            'data' => $allfaq
        ]);
    }
}
