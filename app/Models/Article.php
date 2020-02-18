<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','user_id','category_id','content','views'];

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id','catename');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'article_tags');
    }
}
