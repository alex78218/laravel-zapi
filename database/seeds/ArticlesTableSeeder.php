<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Article::class)->times(100)->make()->each(function($model){
            $model->save();
            \App\Models\ArticleTag::insert([
                ['article_id'=>$model->id,'tag_id'=>rand(1,5)],
                ['article_id'=>$model->id,'tag_id'=>rand(6,10)]
            ]);
        });
    }
}
