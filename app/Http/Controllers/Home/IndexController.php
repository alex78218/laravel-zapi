<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $list = Article::where([])->paginate(10);

        return view('home.index.index',compact('list'));
    }
}
