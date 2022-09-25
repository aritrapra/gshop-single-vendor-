<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Data;

use App\monero\mymonero;

class update_order
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_hash = session()->get('myid');
        $session = Session::where('key_id','=',$user_hash);
        if($user_hash != null and $session->count() == 1){
            $session = $session->first(['hash']);
            $user = Crypt::decrypt($session->hash);
            $pending_orders = Order::where('placed','=','1')
                                ->where('status','=','started')
                                ->where('payment_type','=','btc')
                                ->whereDate( 'created_at', '>', now()->subDays(3))
                                ->where( 'updated_at', '<', now()->subMinutes(3)->toDateTimeString())
                                ->where(DB::raw('BINARY `user`'), $user)
                                ->get();

            $url = "https://blockchain.info/multiaddr?active=";
            $first = 0;
            foreach ($pending_orders as $pd){
                if ($first == 0) {
                    $url = $url.trim($pd->address);
                    $first = 1;
                }else{
                    $url = $url.'|'.trim($pd->address);
                }
            }
            #var_dump($url);
            try {
                $json = file_get_contents($url);
                $data = json_decode($json);
                foreach ($data->addresses as $dt){
                    $order = Order::where('address','=',$dt->address)
                                    ->first();

                    #$btc = $dt->final_balance * 0.00000001;
                    #echo $dt->final_balance;
                    $order_sat = $order->btc_price * 100000000;
                    #echo number_format($order_sat,0);
                    if(intval($order_sat) <= $dt->final_balance){
                        $output_add = Data::where('type','=','address')->first('value');
                        $url = storage_path('myscript.py');
                        $send_req = $url." ".trim($order->mykey)." ".trim($output_add->value);
                        #echo $send_req;
                        #echo $send_req;
                        #echo $send_req;
                        $ret = shell_exec('python2 '.$send_req);
                        #echo $ret;
                        if($ret != 0 and $ret != null){
                            Order::where('address','=',$dt->address)->update([
                                'sendto' => $ret,
                                'status' => 'confirmed'
                            ]);
                        }
                    }
                }
            } catch (\Throwable $th) {
                //throw $th; network problem
            }
            #var_dump($data->addresses);
            #update monero transaction
            $pending_orders = Order::where('placed','=','1')
                                ->where('status','=','started')
                                ->where('payment_type','=','xmr')
                                ->whereDate( 'created_at', '>', now()->subDays(3))
                                ->where( 'updated_at', '<', now()->subMinutes(3)->toDateTimeString())
                                ->where(DB::raw('BINARY `user`'), $user)
                                ->get();

            $all_monero = new mymonero();
            $all_bal = $all_monero->all_balance();
            foreach($pending_orders as $pod){
                $tr = $all_monero->find_transaction($all_bal,$pod->mykey);
                if($tr != null){
                    if($tr['unlocked_balance'] >= number_format($pod->xmr_price,6)){
                        Order::where('id','=',$pod->id)->update([
                            'status' => 'confirmed'
                        ]);
                    }
                }
            }



        }








        #UPDATE_RATE

        $Cheak_update = Data::where( 'updated_at', '<', now()->subMinutes(3)->toDateTimeString())->get();
        foreach ($Cheak_update as $ck) {
            if($ck->type == 'exc_rate'){
                #echo $ck->type;

                $url = storage_path('alwaysrun.py 2>&1');
                $ret = shell_exec("python ".$url);
                $btc = explode('*****',$ret);
                $btco = $btc[0];
                $xmr = $btc[1];
                if($btco > 100000){
                    $all_monero = new mymonero();
                    $all_monero->refresh();
                    Data::where('type','=','exc_rate')->update([
                        'value' => $btco,
                        'updated_at' => now()
                    ]);
                    Data::where('type','=','xmr')->update([
                        'value' => $xmr
                    ]);
                }
            }
        }

        return $next($request);
    }
}
