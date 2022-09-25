<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;

class dashboard extends Controller
{
    public function show(Request $request){
        $add = Data::where('type','=','address')->first('value');
        return view('admin.dashboard',[
            'add' => $add->value
        ]);
    }
    public function updateadd(Request $request){
        $request->validate([
            'add' => 'required|min:10|max:200'
        ]);
        Data::where('type','=','address')->update([
            'value' => $request->add
        ]);
        return redirect()->back();

    }
}
