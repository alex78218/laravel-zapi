<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // 分类
        view()->composer('home.layout',function($view){
            $categories = Category::where([])->orderBy('sort','asc')->limit(6)->get();
            $articleTotal = Article::count();
            $view->with(compact('categories','articleTotal'));
        });

        // 标签
        view()->composer('home.components.sidebar',function($view){
            // $tags = Tag::withCount('articles')->where([])->orderBy('sort','asc')->get();
            // 优化统计方法
            $counts = DB::table('article_tags')
                ->select(DB::raw('count(*) as article_count,tag_id'))
                ->groupBy('tag_id')
                ->pluck('article_count','tag_id')
                ->toArray();
            $tags = Tag::get()->each(function($item) use ($counts){
                $item->article_count = isset($counts[$item->id]) ? $counts[$item->id] : 0;
                return $item;
            });
            $view->with('tags',$tags);
        });

        // 归档
        view()->composer('home.components.sidebar',function($view){
            $monthCal = Article::withoutTrashed()
                ->select(DB::raw('count(*) as acount,date_format(created_at,"%Y-%m") as amonth'))
                ->groupBy('amonth')
                ->orderBy('amonth','desc')
                ->get();

            $view->with('monthCal',$monthCal);
        });


    }
}
