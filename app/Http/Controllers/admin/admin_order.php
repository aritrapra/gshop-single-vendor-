<?php

namespace App\Http\Controllers\admin;

use GPG;
use GPG_Public_Key;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Session;
use App\Models\Orderchat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class admin_order extends Controller
{
    public function getdata(Request $request){
        $orders = Order::where('placed','=','1')
            ->orderBy('created_at','desc');
        $con_orders = $orders->where('status','=','confirmed')->get();
        $shipped = Order::where('placed','=','1')
                        ->orderBy('created_at','desc')
                        ->where('status','=','shipped')
                        ->get();

        return view('admin.orders',[
            'con_orders' => $con_orders,
            'shiporder' => $shipped
        ]);
    }

    public function action(Request $request){
        $order = Order::where('id','=',$request->route('id'));
        if($order->count() == 1){
            $order_data = $order->first();
            $product_data = Product::where('id','=',$order_data->product_id)->first('name');
            $order_user = $order_data->user;
            $user_pgp = User::where('name','=',$order_user)->first('pgp');
            $pgp = $user_pgp->pgp;
            if($pgp != null){
                #test pgp
                return view('admin.shipped',[
                    'order' =>$order_data,
                    'product' => $product_data,
                    'pgp' => 1
                ]);

            }else{
                return view('admin.shipped',[
                    'order' =>$order_data,
                    'product' => $product_data,
                    'pgp' => 0
                ]);
            }

        }else{
            return redirect()->back();
        }
    }

    public function ship(Request $request){
        $request->validate([
            'message' => 'required|min:10|max:1000'
        ]);
        $order = Order::where('id','=',$request->route('id'))->where('status','=','confirmed')->first();
        if($order != null){
            if ($request->has('encrypt')) {
                $user = $order->user;
                $userdata = User::where('name','=',$user)->first(['pgp']);
                require app_path().'/pgp/vendor/autoload.php';
                require_once app_path().'/pgp/libs/GPG.php';
                #echo $userdata->value;
                $gpg = new GPG();
                $pub_key = new GPG_Public_Key($userdata->pgp);
                $encrypted = $gpg->encrypt($pub_key,trim($request->message));
                $order->update([
                    'shipmessage' => $encrypted,
                    'status' => 'shipped'
                ]);
            }else{
                $order->update([
                    'shipmessage' => $request->message,
                    'status' => 'shipped'
                ]);
            }


            return redirect('/godisHusetmyadmin/order_details/'.$request->route('id'));
        }else{
            return redirect()->back();
        }
    }

    public function failed(Request $request){
        $id = $request->route('id');
        if($id == null){
            $page = 0;
        }else{
            $page = $id;
        }
        $all = Order::where('status','=','started')->count();
        $orders = Order::where('status','=','started')
                    ->skip($page*20)
                    ->take(20)
                    ->orderBy('created_at','desc')
                    ->get();
        return view('admin.failed',[
            'order' => $orders,
            'count' => (int)$all/20,
            'nowpage' => $page
        ]);
    }

    public function orderdetail(Request $request){
        $id = $request->route('id');
        $order = Order::where('id','=',$id);
        if($order->count() == 1){
            $order_data = $order->first();
            $product_data = Product::where('id','=',$order_data->product_id)->first(['name','unit']);
            return view('admin.orderdetail',[
                'order' =>$order_data,
                'product' => $product_data
            ]);
        }else{
            return redirect()->back();
        }
    }


    public function chat(Request $request){
        $id = $request->route('id');
        $cheakorder = Order::where('id','=',$id)->count();
        if($cheakorder == 1){
            $allchat = Orderchat::where('orderid','=',$id)->orderBy('created_at','desc')->get();
            return view('admin.chat',[
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
            $new = new Orderchat;
            $new->chatid = hash('sha256',rand(10000000,999999999).$request->message);
            $new->user = 'admin';
            $new->orderid = $id;
            $new->message = $request->message;
            $new->save();
            return redirect()->back();
        }else{
            return redirect('/404');
        }
    }
}
