<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $kw = $request->input('kw');
        $where = [];
        $kw && $where[] = ['show_name','like',"%{$kw}%"];

        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');
        $perPage    = $request->input('per_page');

        $paginator = Permission::where($where)
            ->orderBy($orderField,$orderType)
            ->paginate($perPage);

        return $this->pageData($paginator);
    }

    public function all()
    {
        $list = Permission::where([])
            ->orderBy('id','asc')
            ->get()
            ->toArray();

        return $this->success(compact('list'));
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
        return $this->success($user);
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
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
        $res = User::find($id)->update($data);
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
