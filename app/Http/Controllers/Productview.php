<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class Productview extends Controller
{
    public function showproduct(Request $request){
        $id = $request->route('id');
        $cheak_product = Product::where('id','=',$id)->count();
        if ($cheak_product == 1) {
            $product = Product::where('id','=',$id)->first();
            $reviews = Review::where('product_id','=',$id)->get();
            return view('productview', [
                'reviews' => $reviews,
                'data' => $product,
                'id' => $id
            ]);
        }else{
            return redirect('home');
        }
    }
}
