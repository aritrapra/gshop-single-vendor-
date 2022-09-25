<?php

namespace App\Http\Controllers\admin;

use GPG;
use GPG_Public_Key;
use App\Models\Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class pgp_controller extends Controller
{
    public function show(Request $request){
        $pgp = Data::where('type','=','pgp')->first('data');
        return view('admin.pgp',[
            'pgp' => $pgp->data
        ]);
    }
    public function update(Request $request){
        $request->validate([
            'pgp' => 'required'
        ]);
        #cheak_pgp
        try {
            require app_path().'/pgp/vendor/autoload.php';
            require_once app_path().'/pgp/libs/GPG.php';
            $gpg = new GPG();
            $pub_key = new GPG_Public_Key($request->pgp);
            $encrypted = $gpg->encrypt($pub_key,"test");
            Data::where('type','=',"pgp")->update([
                'data' => $request->pgp
            ]);

        } catch (\Throwable $th) {
            //pass
        }
        return redirect()->back();

    }
}
