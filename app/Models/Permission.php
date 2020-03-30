<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SPermission;

class Permission extends SPermission
{
    protected $fillable = ['show_name','name','guard_name'];

    protected $attributes = [
        'show_name' => '',
        'guard_name' => 'api',
    ];
}
