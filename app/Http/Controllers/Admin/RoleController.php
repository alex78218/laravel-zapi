<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function test(User $userModel)
    {
        //$role = Role::create(['name'=>'admin']);
        //$permission = Permission::create(['name'=>'edit article']);
        $user = $userModel::find(10);
  //      auth()->login($user);
//        $user = auth()->user();
        $user->givePermissionTo('edit article');
        $user->assignRole('admin');

        //$role = Role::find(1);
        //$role->givePermissionTo('edit article');

        dd($user->getAllPermissions()->toArray());
    }

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
