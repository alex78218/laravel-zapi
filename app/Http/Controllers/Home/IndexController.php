<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        $kw = $request->kw;
        $kw && $where[] = ['title','like',"%{$kw}%"];
        $list = Article::with('user','tags','category')->where($where)->paginate(10);
        //dump($list);
        return view('home.index.index',compact('list'));
    }
}
