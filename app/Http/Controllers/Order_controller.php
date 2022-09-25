<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderchat;
use App\Models\Product;
use App\Models\Session;
use Nette\Utils\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Review;
use Facade\FlareClient\Http\Exceptions\BadResponse;

class Order_controller extends Controller
{
    public function show_order(){
        $user_hash = session()->get('myid');
        if($user_hash != null){
            $session = Session::where('key_id','=',$user_hash)->first(['hash']);
            $user = Crypt::decrypt($session->hash);
            $all_orders =  Order::where('placed','=','1')
                                ->where(DB::raw('BINARY `user`'), $user)
                                ->orderBy('created_at','desc')
                                ->get();

            return view('order',[
                'orders' => $all_orders
            ]);
        }else{
            return redirect('/login');
        }
    }
    public function show_details(Request $request){
        $id = $request->route('id');
        $user_hash = session()->get('myid');
        $session = Session::where('key_id','=',$user_hash)->first(['hash']);
        $user = Crypt::decrypt($session->hash);
        $order_count = Order::where('placed','=','1')
                            ->where(DB::raw('BINARY `user`'), $user)
                            ->where('id','=',$id)
                            ->count();
        if ($order_count == 1) {
            $order = Order::where('id','=',$id)->first();
            $product_details = Product::where('id','=', $order->product_id)->first();
            return view('order_status',[
                'product' => $product_details,
                'order' => $order
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function show_review(Request $request){
        $id = $request->route('id');
        $order = Order::where('id','=',$id)
                        ->where('review','=',null);
        if($order->count() == 1){
            $orderdata = $order->first('product_id','id');
            $product = Product::where('id','=',$orderdata->product_id);
            if($product->count() == 1){
                $product = $product->first('name','img','catagori','created_at');
                $start_date = new DateTime($product->created_at);
                $since_start = $start_date->diff(new DateTime(now()));
                if($since_start->days != 0){
                    $online_string = $since_start->days.' dager siden';
                }elseif ($since_start->h != 0) {
                    $online_string = $since_start->h.' timer siden';
                }else{
                    $online_string = $since_start->i.' minutter siden';
                }
                $first_img = asset('assets/productimg/'.explode(',',$product->img)[0]);
                return view('getreview',[
                    'img' => $first_img,
                    'name' => $product->name,
                    'cid' => $request->route('id'),
                    'cat' =>$product->catagori,
                    'st' => $online_string
                ]);
            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }

    }

    public function post_review(Request $request){
        $request->validate([
            'rating' => 'required|min:1|max:5',
            'comment' => 'string'
        ]);
        $user_hash = session()->get('myid');
        $session = Session::where('key_id','=',$user_hash)->first(['hash']);
        $user = Crypt::decrypt($session->hash);
        $id = $request->route('id');
        $order = Order::where('id','=',$id);
        if($order->count() == 1){
            $order = $order->first('product_id');
            $review = new Review;
            $review->id = rand(1000000000,9999999999);
            $review->product_id = $order->product_id;
            $review->comment = $request->comment;
            $review->rating = $request->rating;
            $review->user = $user;
            $review->save();
            Order::where('id','=',$id)->update([
                'review' => '1'
            ]);
            return redirect('/orders');
        }else{
            return redirect()->back();
        }

    }


    public function markdeliver(Request $request){
        if($request->route('id') != null){
            $id = $request->route('id');
            Order::where('id','=',$id)->update([
                'status' => 'delivered'
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function showchat(Request $request){
        $id = $request->route('id');
        $cheakorder = Order::where('id','=',$id)->count();
        if($cheakorder == 1){
            $allchat = Orderchat::where('orderid','=',$id)->orderBy('created_at','desc')->get();
            return view('chat',[
                'data' => $allchat,
                'id' => $id
            ]);
        }else{
            return redirect('/404');
        }


    }

    public function postmsg(Request $request){
        $request->validate([
            'message' => 'required|min:10|max:6000'
        ]);
        $id = $request->route('id');
        $cheakorder = Order::where('id','=',$id)->count();
        if($cheakorder == 1){
            $user_hash = session()->get('myid');
            $session = Session::where('key_id','=',$user_hash)->first(['hash']);
            $user = Crypt::decrypt($session->hash);
            $new = new Orderchat;
            $new->chatid = hash('sha256',rand(10000000,999999999).$request->message);
            $new->user = $user;
            $new->orderid = $id;
            $new->message = $request->message;
            $new->save();
            return redirect()->back();
        }else{
            return redirect('/404');
        }
    }
}
