<?php

namespace App\Http\Controllers\admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class faq_controller extends Controller
{
    public function fq(Request $request){
        $allfaq = Faq::orderBy('created_at','desc')->get();
        return view('admin.faq',[
            'data' => $allfaq
        ]);
    }
    public function add_faq(Request $request){
        $request->validate([
            'faq' => 'required|min:10',
            'details' => 'required|min:10'
        ]);
        Faq::insert([
            'id' => rand(1000000000,9999999999),
            'faq' => $request->faq,
            'details' => $request->details,
            'created_at' => now()
        ]);
        $allfaq = Faq::orderBy('created_at','desc')->get();
        return redirect()->back();
    }
    public function delete(Request $request){
        $id = $request->route('id');
        Faq::where('id','=',$id)->delete();
        return redirect('/godisHusetmyadmin/faq');
    }
}
