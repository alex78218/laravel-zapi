<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        if($request->keyword){
            $where[] = ['name','like','%{$request->keyword}%'];
        }
        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');

        $list = User::where($where)->orderBy($orderField,$orderType)->get()->toArray();

        return $this->success(compact('list'));
    }

    public function store(Request $request)
    {
        $password = $request->password;
        $name = $request->name;
        $email = $request->email;

        $password = Hash::make($password);
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
        return $this->success($user);
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return $this->success($data);
    }

    public function update(Request $request,$id)
    {
        $res = User::withTrashed()->find($id)->update($request->all());
        return $this->success($res);
    }

    public function destroy($id)
    {
        $res = User::find($id)->delete();
        return $this->success($res);
    }

    public function forceDelete($id)
    {
        $res = User::withTrashed()->find($id)->forceDelete();
        return $this->success($res);
    }
}
