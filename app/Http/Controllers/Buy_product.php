<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Order;
use App\Models\Product;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use GPG;
use GPG_Public_Key;
use App\monero\mymonero;
class Buy_product extends Controller
{
    public function payout(Request $request){
        $request->validate([
            'id' => 'required',
            'veriant' => 'required|numeric|min:0'
        ]);

        $cheak_product = Product::where('id','=', $request->id)->count();
        if ($cheak_product == 1) {
            #### BTC VALUE1963
            $exc_value = Data::where('type','=','exc_rate')->first('value');
            $xmr_data = Data::where('type','=','xmr')->first('value');

            $xmr_value = 1 / $xmr_data->value;

            $btc_value = 1 / $exc_value->value;
            /***
            $url = storage_path('getaddress.py 2>&1');
            $ret = shell_exec("C:\Python27\python ".$url);
            $add = explode("*#portal#*",$ret)[0];
            $key = explode("*#portal#*",$ret)[1];

            ***/
            $user_hash = session()->get('myid');
            $session = Session::where('key_id','=',$user_hash)->first(['hash']);
            $user = Crypt::decrypt($session->hash);
            $product_details = Product::where('id','=', $request->id)->first();
            try {
                $selected_veriant = explode('-',$product_details->veriant)[$request->veriant];
                $total_price = explode(',',$selected_veriant)[1];
            } catch (\Throwable $th) {
                return redirect()->back();
            }
            $orders = Order::where('product_id','=',$request->id)
                            ->where('placed','=','0')
                            ->whereDate( 'created_at', '>', now()->subDays(3))
                            ->where('total_price','=',$total_price)
                            ->where(DB::raw('BINARY `user`'), $user);
            if($orders->count() == 0){
                $order_id = rand(10000000,9999999999);
                $order = new Order;
                $order->id = $order_id;
                $order->veriant = $selected_veriant;
                $order->product_id = $request->id;
                $order->total_price = $total_price;
                $order->btc_price = $total_price * $btc_value;
                $order->xmr_price = $total_price * $xmr_value;
                $order->placed = 0;
                $order->user = $user;
                $order->status = 'started';
                $order->save();
                return redirect('/payout'."/".$order_id);
            }elseif($orders->count() == 1){
                $data = $orders->first('id');
                return redirect('/payout'."/".$data->id);
            }else{
                return redirect()->back();
            }


        }else{
            return redirect()->back();
        }
    }

    public function show_payout(Request $request){
        $id = $request->route('id');
        $user_hash = session()->get('myid');
        $session = Session::where('key_id','=',$user_hash)->first(['hash']);
        $user = Crypt::decrypt($session->hash);
        $orders = Order::where('id','=',$id)
                            ->where('placed','=','0')
                            ->where(DB::raw('BINARY `user`'), $user)
                            ->first();

        if($orders != null){
            $exc_value = Data::where('type','=','exc_rate')->first('value');
            $product_details = Product::where('id','=', $orders->product_id)->first();
            return view('payout',[
                'product' => $product_details,
                'veriant' => $orders->veriants,
                'price' => $orders->total_price,
                'btc' => $orders->btc_price,
                'xmr' => $orders->xmr_price,
                'id' => $id,
                'now_value' => number_format($exc_value->value,2),
                'address' => $orders->address
            ]);
        }


    }



    public function confirm(Request $request){
        $request->validate([
            'id' =>'required|min:7|max:12',
            'message' => 'required|min:10|max:4000',
            'pay' => 'required'
        ]);

        $order = Order::where('id','=',$request->id)->count();
        if ($order == 1) {
            require app_path().'/pgp/vendor/autoload.php';
            require_once app_path().'/pgp/libs/GPG.php';
            $order_data = Order::where('id','=',$request->id)->first();
            $product_details = Product::where('id','=', $order_data->product_id)->first();
            $userdata = Data::where('type','=','pgp')->first('data');
            #echo $userdata->value;
            $gpg = new GPG();
            $pub_key = new GPG_Public_Key($userdata->data);
            $encrypted = $gpg->encrypt($pub_key,trim($request->message));
            $message = $encrypted;
            if($request->pay == 'btc'){
                $url = storage_path('getaddress.py 2>&1');
                $ret = shell_exec("python2 ".$url);
                $add = explode("*#portal#*",$ret)[0];
                $key = explode("*#portal#*",$ret)[1];
                Order::where('id','=',$request->id)->update([
                    'placed' => '1',
                    'address' => $add,
                    'payment_type' => 'btc',
                    'mykey' => $key,
                    'message' => $message
                ]);
                return redirect('/showorder'.'/'.$request->id);
            }elseif($request->pay == 'xmr'){
                $c  = new mymonero();
                $add = $c->new_add($request->id);
                #echo $add['add'];
                #$add = explode("*#portal#*",$ret)[0];
                #$key = explode("*#portal#*",$ret)[1];
                Order::where('id','=',$request->id)->update([
                    'placed' => '1',
                    'address' => $add['add'],
                    'payment_type' => 'xmr',
                    'mykey' => $add['id'],
                    'message' => $message
                ]);
                return redirect('/showorder'.'/'.$request->id);
            }else{
                return redirect()->back();
            }




        }else{
            return redirect()->back();
        }

    }
}
