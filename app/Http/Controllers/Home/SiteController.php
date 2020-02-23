<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $kw = $request->kw;
        $month = $request->month;
        $list = Article::with(['user','tags','category'])
            ->when($kw,function($query) use ($kw){
                $query->where('title','like',"%{$kw}%");
            })
            ->when($month,function($query) use ($month){
                $begin = date("Y-m-01",strtotime($month));
                $end = date("Y-m-d",strtotime("$month +1 month"));
                $query->whereBetween('created_at',[$begin,$end]);
            })
            ->paginate(config('blog.perpage'));

        return view('home.site.index',compact('list'));
    }

    public function category($id)
    {
        $list = Article::with(['user','tags','category'])
            ->where('category_id',$id)
            ->paginate(config('blog.perpage'));

        return view('home.site.index',compact('list'));
    }

    public function tag($id)
    {
        $tag = Tag::find($id);
        $list = Article::with(['user','category'])
            ->whereHas('tags',function($query) use ($id){
                return $query->where('tags.id',$id);
            })
            ->paginate(config('blog.perpage'));

        return view('home.site.index',compact('tag','list'));
    }

    public function article($id)
    {
        $article = Article::with(['user','category','tags'])->find($id);
        $prev = Article::withoutTrashed()->where('id','<',$id)->orderBy('id','desc')->first();
        $next = Article::withoutTrashed()->where('id','>',$id)->orderBy('id','asc')->first();

        return view('home.site.article',compact('article','prev','next'));
    }

    public function note()
    {
        return view('home.site.note');
    }
}
