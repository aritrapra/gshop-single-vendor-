<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class News_controller extends Controller
{
    public function show_news(Request $request){
        $allnews = News::orderBy('created_at','desc')->get();
        return view('news',[
            'news' => $allnews
        ]);
    }
}
