<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
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
        // 标签
        view()->composer('*',function($view){
            $tags = Tag::withCount('articles')->where([])->orderBy('sort','asc')->get();
            //dd($tags);
            $view->with('tags',$tags);
        });

        // 分类
        view()->composer('*',function($view){
            $categories = Category::where([])->orderBy('sort','asc')->limit(6)->get();
            $view->with('categories',$categories);
        });
    }
}
