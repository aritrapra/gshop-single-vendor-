<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Catagories extends Controller
{
    public function getdata(Request $request){
        $catagories = DB::table('catagories')
            ->get('cat');
        return view('admin.catagori',[
            'cat' => $catagories,
        ]);
    }

    public function deletemaincat(Request $request){
        DB::table('catagories')
            ->where('cat','=',$request->route('cat'))
            ->delete();
        return redirect('/godisHusetmyadmin/catagori');
    }


    public function addcat(Request $request){
        $request->validate([
            'cat' => 'required'
        ]);
        DB::table('catagories')->insert([
            'cat' => $request->cat
        ]);
        return redirect('/godisHusetmyadmin/catagori');
    }

}
