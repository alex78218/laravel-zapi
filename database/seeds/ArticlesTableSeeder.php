<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();
        factory(Article::class)->times(100)->make()->each(function($model){
            $model->save();
            \App\Models\ArticleTag::insert([
                ['article_id'=>$model->id,'tag_id'=>rand(1,5)],
                ['article_id'=>$model->id,'tag_id'=>rand(6,10)]
            ]);
        });
    }
}
