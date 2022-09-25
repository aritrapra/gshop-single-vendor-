<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class News_controller extends Controller
{
    public function show_news(Request $request){
        $news = News::orderBy('created_at','desc')->get();
        return view('admin.news',[
            'news' => $news
        ]);
    }
    public function add_news(Request $request){
        $request->validate([
            'news' => 'required',
            'details' => 'required'
        ]);
        $news = new News;
        $news->id = rand(10000000,9999999999);
        $news->heading = $request->news;
        $news->news = $request->details;
        $news->save();
        return redirect('/godisHusetmyadmin/news');
    }
    public function delete(Request $request){
        $id = $request->route('id');
        News::where('id','=',$id)->delete();
        return redirect('/godisHusetmyadmin/news');
    }
}
