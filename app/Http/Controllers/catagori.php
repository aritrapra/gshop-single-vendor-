<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catagori extends Controller
{
    public function showcat(Request $request){
        $search_cat = $request->route('cat');
        $cheak_cat = DB::table('catagories')->where('cat','=',$search_cat)->count();
        if ($cheak_cat == 1) {
            $products = Product::where('catagori','=',$search_cat)->where('active','=','1')->get();
            return view('catagories',[
                'products' => $products
            ]);
        }else{
            return redirect('home');
        }

    }
}
