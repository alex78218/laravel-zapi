<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class BaseController extends Controller
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
