<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as PermissionRole;

class Role extends PermissionRole
{
    protected $fillable = ['name','guard_name','remark'];

    protected $attributes = [
        'guard_name' => 'api',
        'remark' => ''
    ];
}
