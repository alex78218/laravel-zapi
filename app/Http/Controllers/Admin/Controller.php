<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Traits\ApiResponse;

class Controller extends BaseController
{
    use ApiResponse;

    protected $authUser = null;

    public function __construct()
    {
        if(auth()->user()){
            $this->authUser = auth()->user();
            request()->request->set('user_id',$this->authUser->id);
        }
    }
}
