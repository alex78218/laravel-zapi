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
        //$this->authUser->syncRoles(1);
        //$this->authUser->syncPermissions(194);
        $kw = $request->input('kw');
        $where = [];
        $kw && $where[] = ['name','like',"%{$kw}%"];

        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');
        $perPage    = $request->input('per_page');

        $paginator = User::with('roles')
            ->where($where)
            ->orderBy($orderField,$orderType)
            ->paginate($perPage);

        return $this->pageData($paginator);
    }

    public function store(Request $request)
    {
        $password = $request->input('password');
        $name = $request->input('name');
        $email = $request->input('email','');

        $password = Hash::make($password);
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
        $user->syncRoles($request->input('role_ids',[]));
        return $this->success($user);
    }

    public function show($id)
    {
        $data = User::with('roles')->findOrFail($id);
        return $this->success($data);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'name'  => $request->input('name'),
            'email' => $request->input('email')
        ];
        $password = $request->input('password');
        if($password){
            $data['password'] = Hash::make($password);
        }
        $user = User::findOrFail($id);
        $user->syncRoles($request->input('role_ids',[]));
        $res = $user->update($data);
        return $this->success($res);
    }

    public function destroy($id)
    {
        $res = User::find($id)->delete();
        return $this->success($res);
    }

    public function forceDelete($id)
    {
        $res = User::find($id)->forceDelete();
        return $this->success($res);
    }
}
