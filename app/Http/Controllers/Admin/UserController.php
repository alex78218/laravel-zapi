<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
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

    public function store(UserRequest $request)
    {
        $data = [
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password'))
        ];
        $user = User::create($data);
        $user->syncRoles($request->input('role_ids',[]));
        return $this->success($user);
    }

    public function show($id)
    {
        $data = User::with('roles')->findOrFail($id);
        return $this->success($data);
    }

    public function update(UserRequest $request,$id)
    {
        $data = [
            'name'  => $request->input('name'),
            'email' => $request->input('email')
        ];
        if($request->input('password')){
            $data['password'] = Hash::make($request->input('password'));
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
