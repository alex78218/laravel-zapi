<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        $kw = $request->kw;
        $kw && $where[] = ['title','like',"%{$kw}%"];
        $list = Article::with(['user','tags','category'])->where($where)->paginate(8);
        //dump($list);
        return view('home.site.index',compact('list'));
    }

    public function category(Request $request)
    {
        $where = [];
        $where[] = ['category_id','=',$request->id];
        $list = Article::with(['user','tags','category'])->where($where)->paginate(8);
        //dump($list);
        return view('home.site.index',compact('list'));
    }

    public function tag(Request $request)
    {
        $where = [];
        $kw = $request->kw;
        $kw && $where[] = ['title','like',"%{$kw}%"];
        $list = Article::with(['user','tags','category'])->where($where)->paginate(8);
        //dump($list);
        return view('home.site.index',compact('list'));
    }

    public function note()
    {
        return view('home.site.note');
    }
}
