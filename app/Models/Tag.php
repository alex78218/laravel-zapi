<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = ['tagname','sort'];
}
