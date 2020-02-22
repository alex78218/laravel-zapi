<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;


    protected $fillable = ['tagname','sort'];

    public function articles()
    {
        return $this->belongsToMany(Article::class,'article_tags');
    }
}
