<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function getdata(){

        return view('admin.login');
    }
    public function login(Request $request){
        $request->validate([
            'adname' => 'required',
            'password' => 'required'
        ]);
        if(hash('sha256',$request->adname) == 'e7d3e769f3f593dadcb8634cc5b09fc90dd3a61c4a06a79cb0923662fe6fae6b'){
            if (hash('sha256',$request->password) == '54a5445723e36cebafce27ff5ca43b6f0adbd196f4cd4a11968125d00ad09765') {
                $string = "Cheaked Admin Goodiesetuser GodiesetPass2021";
                $request->session()->put('adminuser',hash('sha256',$string));

                return redirect('/godisHusetmyadmin/dashboard');
            }else {
                return redirect()->back()->withErrors(['adname' => 'You Have Entering Wrong Credential']);
            }
        }else {
            return redirect()->back()->withErrors(['adname' => 'You Have Entering Wrong Credential']);
        }
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
}
