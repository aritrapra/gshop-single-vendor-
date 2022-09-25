<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Review;

class Products extends Controller
{
    public function show_products(Request $request){
        if ($request->route('id') !== null) {
            $start = 10 * $request->route('id');
        }else {
            $start = 0;
        }
        $allproducts = Product::skip($start)
            ->take(10)
            ->orderBy('created_at','desc')
            ->get();
        $count1 = Product::count();
        if($count1 >= ($start + 10)){
            $show = ($start + 1)." to ".($start + 10);
        }else{
            $show = ($start + 1)." to ".$count1;
        }
        $count = $count1/10;

        return view('admin.product',[
            'product' => $allproducts,
            'count' => (int)$count,
            'id' => $request->route('id'),
            'total' => $count1,
            'showing' => $show
        ]);
    }
    public function praction(Request $request){
        if($request->submit == 'active'){
            DB::table('productdetails')->where('id','=',$request->route('id'))->update([
                'active' => 'yes'
            ]);
            return redirect('/Norskeadmin2021/products');
        }elseif ($request->submit == 'inactive') {
            DB::table('productdetails')->where('id','=',$request->route('id'))->update([
                'active' => 'no'
            ]);
            return redirect('/Norskeadmin2021/products');
        }elseif ($request->submit == 'delete') {

            $count = DB::table('orders')
                ->where('prid','=',$request->route('id'))
                ->where('status',"<=",'3')
                ->count();
            if($count > 0){
                return redirect()->back()->withErrors(['msg' => 'This Product Have Active Order']);
            }else {
                DB::table('productdetails')->where('id','=',$request->route('id'))->delete();
                return redirect('/Norskeadmin2021/products');
            }

        }
        elseif ($request->submit == 'feature') {
            DB::table('productdetails')->where('id','=',$request->route('id'))->update([
                'feature' => 'yes'
            ]);
            return redirect('/Norskeadmin2021/products');
        }
        elseif ($request->submit == 'defeature') {
            DB::table('productdetails')->where('id','=',$request->route('id'))->update([
                'feature' => 'no'
            ]);
            return redirect('/Norskeadmin2021/products');
        }elseif ($request->submit == 'view') {

            return redirect('/Norskeadmin2021/viewproduct/'.$request->route('id'));
        }else{
            echo('failed');
        }
    }
    public function getproductdata(Request $request){
        $data = DB::table('productdetails')->where('id','=',$request->route('id'))->first();
        return view('admin.productdetails',[
            'data' => $data
        ]);
    }

    public function add(){
        return redirect('/godisHusetmyadmin/product/add1/'.rand(00000000,9999999999));
    }

    public function add1(Request $request){
        $id = $request->route('id');
        $catagories = DB::table('catagories')->get('cat');
        $cheak_product = Product::where('id','=',$id)->get();
        if ($cheak_product->count() != 0) {
            $cheak_product = $cheak_product->first();
            return view('admin.add1', [
                'id' => $id,
                'name' => $cheak_product->name,
                'details' => $cheak_product->details,
                'catagori' => $cheak_product->catagori,
                'unit' => $cheak_product->unit,
                'delivary' => $cheak_product->delivary,
                'cats' => $catagories,
            ]);
        }else{
            return view('admin.add1', [
                'id' => $id,
                'name' => null,
                'details' => null,
                'catagori' => null,
                'unit' => null,
                'delivary' => null,
                'cats' => $catagories,
            ]);
        }
    }

    public function clone(Request $request){
        $id = $request->route('id');
        $catagories = DB::table('catagories')->get('cat');
        $cheak_product = Product::where('id','=',$id)->get();
        if($cheak_product->count() != 0){
            $thisid = rand(00000000,9999999999);
            $data = $cheak_product->first();
            $product = new Product;
            $product->id = $thisid;
            $product->name = $data->name;
            $product->details = $data->details;
            $product->catagori = $data->catagori;
            $product->unit = $data->unit;
            $product->delivary = $data->delivary;
            $product->veriant = $data->veriant;
            $product->save();
            return redirect('/godisHusetmyadmin/product/add1/'.$thisid);
        }else{
            return redirect()->back();
        }
    }


    public function post_add1(Request $request){
        $id = $request->route('id');
        $request->validate([
            'name' => 'required|min:6|max:40',
            'details' => 'required|min:10|max:2000',
            'catagories' => 'required',
            'unit' => 'required',
            'delivary' => 'required'
        ]);
        $cheak_product = Product::where('id','=',$id)->get();
        if($cheak_product->count() != 1){
            $mypro = new Product;
            $mypro->id = $id;
            $mypro->name = $request->name;
            $mypro->details = $request->details;
            $mypro->catagori = $request->catagories;
            $mypro->unit = $request->unit;
            $mypro->delivary = $request->delivary;
            $mypro->save();

        }else{
            Product::where('id','=',$id)->update([
                'name' => $request->name,
                'details' => $request->details,
                'catagori' => $request->catagories,
                'unit' => $request->unit,
                'delivary' => $request->delivary
            ]);
        }
        return redirect('/godisHusetmyadmin/product/add2/'.$id);
    }
    public function add2(Request $request){
        $id = $request->route('id');
        $cheak_product = Product::where('id','=',$id);
        if($cheak_product->count() != 1){
            return redirect('/404error');
        }else{
            $cheak_product = $cheak_product->first(['unit','veriant']);
            $veriants = explode('-',$cheak_product->veriant);
            return view('admin.add2',[
                'veriants' => $veriants,
                'id' => $id,
                'unit' => $cheak_product->unit
            ]);
        }
    }
    public function post_add2(Request $request){
        $id = $request->route('id');
        $request->validate([
            'quantity' => 'required|min:0',
            'price' => 'required|min:0'
        ]);
        $product = Product::where('id','=',$id)->first(['veriant']);
        if($product->veriant != null){
            $new_veriant = $product->veriant."-".$request->quantity.",".$request->price;
        }else{
            $new_veriant = $request->quantity.",".$request->price;
        }
        Product::where('id','=',$id)->update([
            'veriant' => $new_veriant
        ]);
        return redirect('/godisHusetmyadmin/product/add2/'.$id);
    }
    public function remove1(Request $request){
        $id = $request->route('id');
        $product = Product::where('id','=',$id)->first(['veriant']);
        $list = explode('-',$product->veriant);
        unset($list[$request->route('sel')]);
        $new_veriant = implode('-',$list);
        Product::where('id','=',$id)->update([
            'veriant' => $new_veriant
        ]);
        return redirect('/godisHusetmyadmin/product/add2/'.$id);
    }
    public function add3(Request $request){
        $id = $request->route('id');
        $cheak_product = Product::where('id','=',$id);
        if($cheak_product->count() != 1){
            return redirect('/404error');
        }else{
            $cheak_product = $cheak_product->first(['img']);
            $img = explode(',',$cheak_product->img);
            return view('admin.add3',[
                'imgs' => $img,
                'id' => $id
            ]);
        }
    }
    public function post_add3(Request $request){
        $id = $request->route('id');
        if ($request->submit == 'back') {
            return redirect('/godisHusetmyadmin/product/add2/'.$id);
        }else if ($request->submit == "upload"){
            $request->validate([
                'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|min:5'
            ]);
            $imageName1 = random_int(1000000000,99999999999);
            $imageName = $imageName1.'.jpg';
            $request->images->move(public_path('/assets/productimg'), $imageName);
            $cheak_product = Product::where('id','=',$id)->first(['img']);
            if ($cheak_product->img != null) {
                $img_string = $cheak_product->img.','.$imageName;

            }else{
                $img_string = $imageName;
            }
            Product::where('id','=',$id)->update([
                    'img' => $img_string
                ]);
            return redirect('/godisHusetmyadmin/product/add3/'.$id);
        }
    }
    public function remove2(Request $request){
        $id = $request->route('id');
        $product = Product::where('id','=',$id)->first(['img']);
        $list = explode(',',$product->img);
        unset($list[$request->route('sel')]);
        $new_img = implode(',',$list);
        Product::where('id','=',$id)->update([
            'img' => $new_img
        ]);
        return redirect('/godisHusetmyadmin/product/add3/'.$id);
    }
    public function finish(Request $request){
        $id = $request->route('id');
        Product::where('id','=',$id)->update([
            'active' => '1'
        ]);
        return redirect('/godisHusetmyadmin/products');
    }

    public function pause(Request $request){
        $id = $request->route('id');
        $c = Product::where('id','=',$id)->first('active');
        if($c->active == '1'){
            $val = "0";
        }else{
            $val = "1";
        }
        Product::where('id','=',$id)->update([
            'active' => $val
        ]);
        return redirect()->back();
    }

    public function delete(Request $request){
        $id = $request->route('id');
        Product::where('id','=',$id)->delete();
        return redirect('/godisHusetmyadmin/products/'.$request->route('page'));
    }

    public function reviews(Request $request){
        $id = $request->route('id');
        $reviews = Review::where('product_id','=',$id)->get();
        return view('admin.reviews',[
            'reviews' => $reviews
        ]);
    }

    public function remove_review(Request $request){
        $id = $request->route('id');
        Review::where('id','=',$id)->delete();
        return redirect()->back();
    }
}
