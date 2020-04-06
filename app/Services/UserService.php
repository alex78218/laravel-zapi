<?php

namespace App\Services;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct()
    {

    }

    public static function isNameExist(String $name,int $excId=null)
    {
        return User::where('name',$name)
            ->when($excId,function($query) use ($excId) {
                $query->where('id','<>',$excId);
            })->exists();
    }

    public static function isEmailExist(String $email,int $excId=null)
    {
        return User::where('email',$email)
            ->when($excId,function($query) use ($excId) {
                $query->where('id','<>',$excId);
            })->exists();
    }
}
