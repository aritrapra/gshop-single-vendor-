<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class Users extends Controller
{
    public function getdata(Request $request){
        if ($request->route('id') !== null) {
            $start = 10 * $request->route('id');
        }else {
            $start = 0;
        }
        $allusers = User::skip($start)
            ->take(10)
            ->orderBy('created_at','desc')
            ->get();
        $count = User::count();
        $count = $count/10;
        return view('admin.users',[
            'users' => $allusers,
            'count' => (int)$count,
            'id' => $request->route('id')
        ]);
        
    }
    public function useraction(Request $request){
        if($request->submit == 'view'){
            return redirect('/Norskeadmin2021/viewuser/'.$request->route('id'));
        }elseif ($request->submit == 'vendor') {
            User::where('name','=',$request->route('id'))->update([
                'actype' => 'vendor'
            ]);
            return redirect('/Norskeadmin2021/users/');
        }elseif ($request->submit == 'normal') {
            User::where('name','=',$request->route('id'))->update([
                'actype' => 'normal'
            ]);
            return redirect('/Norskeadmin2021/users/');
        }elseif ($request->submit == 'trust') {
            User::where('name','=',$request->route('id'))->update([
                'trustvendor' => '1'
            ]);
            return redirect('/Norskeadmin2021/users/');
        }elseif ($request->submit == 'untrust') {
            User::where('name','=',$request->route('id'))->update([
                'trustvendor' => '0'
            ]);
            return redirect('/Norskeadmin2021/users/');
        }elseif ($request->submit == 'ban') {
            User::where('name','=',$request->route('id'))->update([
                'ban' => '1'
            ]);
            return redirect('/Norskeadmin2021/users/');
        }elseif ($request->submit == 'unban') {
            User::where('name','=',$request->route('id'))->update([
                'ban' => '0'
            ]);
            return redirect('/Norskeadmin2021/users/');
        }
    }

    public function getuserdata(Request $request){
        $profileuser = User::where('name','=',$request->route('id'))->first();
        if($profileuser->profile_img != null){
            $user_img = '/assets/profileimgs/'.$profileuser->profile_img.'.jpg';
        }else{
            $user_img = '/assets/image/index.jpg';
        }
        return view('admin.profile',[
            'data' => $profileuser,
            'img' => $user_img
        ]);
    }
}
