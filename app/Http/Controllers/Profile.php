<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use GPG;
use GPG_Public_Key;
class Profile extends Controller
{
    public function show(){
        return view('profile',[
            'data' => ''
        ]);
    }
    public function twofactor(Request $request){
        $user_hash = session()->get('myid');
        $session = Session::where('key_id','=',$user_hash)->first(['hash']);
        $user = Crypt::decrypt($session->hash);

        $user_data = User::where(DB::raw('BINARY `name`'), $user)->first(['two_factor','pgp']);
        if($user_data != null){
            if($user_data->pgp != null){
                if($request->twofactor == 'enable'){
                    User::where(DB::raw('BINARY `name`'), $user)->update([
                        'two_factor' => '1'
                    ]);
                }else if($request->twofactor == 'disable'){
                    User::where(DB::raw('BINARY `name`'), $user)->update([
                        'two_factor' => '0'
                    ]);
                }
                return redirect()->back();
            }else{
                return redirect('/setpgp');
            }
        }else{

            return redirect('/login');
        }


    }
    public function setpgp(){
        return view('profileedit');
    }
    public function setnewpgp(Request $request){
        $request->validate([
            'pgp' => 'required|min:1023|max:3999'
        ]);
        $key_id = session()->get('myid');
        $session = Session::where('key_id','=',$key_id)->first('hash');
        $user = Crypt::decrypt($session->hash);
        User::where(DB::raw('BINARY `name`'), $user)
            ->update([
                'temp_pgp' => $request->pgp
            ]);
        return redirect('/verify');

    }
    public function verify(Request $request){
        try {
            $key_id = session()->get('myid');
            $session = Session::where('key_id','=',$key_id)->first('hash');
            $user = Crypt::decrypt($session->hash);
            $userdata = User::where(DB::raw('BINARY `name`'), $user)->first('temp_pgp');
            $content = File::get(storage_path('datas/data.txt'));
            $datas = preg_split("/\r\n|\n|\r/", $content);
            $new_string = '';
            for($i = 0; $i < 12;$i++){
                $new_string = $new_string.' '.$datas[rand(0,count($datas)-1)];
            }
            User::where(DB::raw('BINARY `name`'), $user)
                ->update([
                    'temp_security' => trim($new_string)
                ]);
            require app_path().'/pgp/vendor/autoload.php';
            require_once app_path().'/pgp/libs/GPG.php';
            $gpg = new GPG();
            $pub_key = new GPG_Public_Key($userdata->temp_pgp);
            $encrypted = $gpg->encrypt($pub_key,trim($new_string));
            return view('verify',[
                'msg' => $encrypted
            ]);
        } catch (\Throwable $th) {
            return redirect("/setpgp")->withErrors(['pgp' => 'PGP key du ført er ugyldig']);
        }
    }

    public function verifypgp(Request $request){
        $request->validate([
            'msg' => 'required|min:12|max:1000'
        ]);
        $key_id = session()->get('myid');
        $session = Session::where('key_id','=',$key_id)->first('hash');
        $user = Crypt::decrypt($session->hash);
        $userdata = User::where(DB::raw('BINARY `name`'), $user)->first(['temp_security','temp_pgp']);
        #echo($userdata->temp_pgp);
        if($userdata->temp_security == $request->msg){
            User::where(DB::raw('BINARY `name`'), $user)->update([
                'pgp' => $userdata->temp_pgp
            ]);
        return redirect('/profile');
        }else{
            return redirect()->back()->withErrors(['msg' => 'Verification Failed, Try Again']);
        }
    }
}
