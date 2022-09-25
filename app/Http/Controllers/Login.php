<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Session;
use App\Rules\captcha;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use GPG;
use GPG_Public_Key;

use Illuminate\Support\Facades\DB;

class Login extends Controller
{
    public function register(Request $req){
        $validate = $req->validate([
              'name' => 'required|unique:users|alpha_num|min:6|max:20',
              'password' => 'required|confirmed|min:8',
              'captcha' => ['required', new captcha($req->input('captcha_confirm'),$req->name)],
        ]);
        $req->session()->put('name',$req->input('name'));
        $req->session()->put('password',$req->input('password'));

        $content = File::get(storage_path('datas/data.txt'));
        $datas = preg_split("/\r\n|\n|\r/", $content);
        $new_string = '';
        for($i = 0; $i < 12;$i++){
            $new_string = $new_string.' '.$datas[rand(0,count($datas)-1)];
        }
        $req->session()->put('key',trim($new_string));

        return redirect('/memmonic');

    }
    public function show_key(Request $request){
        return view('memmonic', [
            'key' => $request->session()->get('key')
        ]);
    }
    public function register_key(Request $request){
        $request->validate([
            'key' => 'required|string'
        ]);
        if($request->key == $request->session()->get('key')){
            $user = new User;
            $user->name = $request->session()->get('name');
            $user->password = hash('sha256', $request->session()->get('password'));
            #echo hash('sha256', $request->session()->get('password'));
            $user->memmonic = hash('sha256', $request->key);
            $user->balence = '0.00';
            $user->save();
            return redirect('/login')->withErrors(['User_registered' => 'Bruker Registrert! Vennligst logg inn']);
        }else{
            return redirect()->back()->withErrors(['key' => "Key Noy Matched"]);
        }
    }
    public function log_in(Request $request)
    {
        $request->validate([
            'Username'=> 'required|alpha_num|min:6|max:20',
            'password' => 'required|min:8',
            'captcha' => ['required', new captcha($request->input('captcha_confirm'),$request->Username)],
        ]);
        $user_count = User::where(DB::raw('BINARY `name`'), $request->Username)
            ->count();
        if($user_count == 1){
            $user_data = User::where(DB::raw('BINARY `name`'), $request->Username)->first(['password','two_factor']);
            if($user_data->password == hash('sha256', $request->password)){
                $user_hash = hash('sha256', $request->Username.now()."M2");
                $encrypt_user = Crypt::encrypt($request->Username);
                $my_session = new Session;
                $my_session->key_id = $user_hash;
                $my_session->hash = $encrypt_user;
                $my_session->misc = 'Its Security Phase';
                $my_session->save();
                session()->put('myid',$user_hash);
                session()->put('key',now());
                if($user_data->two_factor == 1){
                    return redirect('/twofactorcheak');
                }else{
                    User::where(DB::raw('BINARY `name`'), $request->Username)->update(['last_login' => now()]);
                    return redirect('/home');
                }



            }else{
                return redirect()->back()->withErrors(['password'=> 'Passord matcher ikke']);
            }
        }else{
            return redirect()->back()->withErrors(['Username'=> 'Brukernavn eksisterer ikke']);
        }
    }
    public function show_forgot(){
        return view('forgot_password');
    }
    public function forgot_cheak(Request $request){
        $request->validate([
            'user' => 'required|alpha_num',
            'key' => 'required|string',
            'captcha' => ['required', new captcha($request->input('captcha_confirm'),$request->user)],
        ]);
        $memmonic_hash = hash('sha256',$request->key);
        $user_data = User::where(DB::raw('BINARY `name`'), $request->user);
        if($user_data->count() == 1){
            $user_data = $user_data->first('memmonic');
            if($memmonic_hash == $user_data->memmonic){
                $key = hash('sha256',$request->user.now());
                $encrypt_user = Crypt::encrypt($request->user);
                $session = new Session;
                $session->key_id = $key;
                $session->hash = $encrypt_user;
                $session->misc = "Reset_pass";
                $session->save();
                session()->put('key',$key);
                return redirect('/set_new_password');
            }
            else{
                return redirect()->back()->withErrors(['user' => "Key Not Matched"]);
            }
        }else{
            return redirect()->back()->withErrors(['user' => "Brukernavn finnes ikke"]);
        }

    }
    public function set_password(){
        return view('set_new_password');
    }
    public function new_password(Request $request){
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);
        $key_id = session()->get('key');
        $session = Session::where(DB::raw('BINARY `key_id`'), $key_id)->first('hash');

        $user = Crypt::decrypt($session->hash);
        User::where(DB::raw('BINARY `name`'),$user)->update([
            'password' => hash('sha256',$request->password)
        ]);
        return redirect('/login')->withErrors(['User_registered' => 'Passord endret! Vennligst logg inn']);
    }

    public function twofactor(Request $request){
        #$cats = DB::table('catagories')->get();
        try {
            $key_id = session()->get('myid');
            $session = Session::where('key_id','=',$key_id)->first('hash');
            $user = Crypt::decrypt($session->hash);
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
            $userdata = User::where(DB::raw('BINARY `name`'), $user)->first('pgp');
            $gpg = new GPG();
            $pub_key = new GPG_Public_Key($userdata->pgp);
            $encrypted = $gpg->encrypt($pub_key,trim($new_string));
            return view('twofactor',[
                'msg' => $encrypted,
            ]);
        } catch (\Throwable $th) {
            return redirect('/login');
        }
    }

    public function verify(Request $request){
        $request->validate([
            'decode' => 'required|min:10|max:500'
        ]);
        $key_id = session()->get('myid');
        $session = Session::where('key_id','=',$key_id)->first('hash');
        $user = Crypt::decrypt($session->hash);
        $userdata = User::where(DB::raw('BINARY `name`'), $user)->first('temp_security');
        if($userdata->temp_security == $request->decode){
            $string = hash('sha256','M_its'.$user);
            session()->put('key1',$string);
            return redirect('/home');
        }else{
            return redirect()->back()->withErrors(['decode' => 'Verfiisering feilet']);
        }
    }

    public function logout(){
        session()->flush();
        return redirect('/login');
    }

}
