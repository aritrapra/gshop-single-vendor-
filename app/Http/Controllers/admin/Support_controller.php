<?php

namespace App\Http\Controllers\admin;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Support_controller extends Controller
{
    public function show_support(){
        $all_support = Support::orderBy('created_at','desc')->get();
        return view('admin.supports',[
            'support' => $all_support
        ]);
    }
}
