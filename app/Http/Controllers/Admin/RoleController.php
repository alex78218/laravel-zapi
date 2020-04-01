<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        app()->cache->forget('spatie.permission.cache');
    }

    public function index(Request $request)
    {
        $kw = $request->input('kw');
        $where = [];
        if($kw){
            $where[] = ['name','like',"%{$kw}%"];
        }
        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');
        $perPage    = $request->input('per_page');

        $paginator = Role::where($where)
            ->orderBy($orderField,$orderType)
            ->paginate($perPage);

        return $this->pageData($paginator);
    }

    public function all()
    {
        $list = Role::where([])
            ->orderBy('id','asc')
            ->get()
            ->toArray();

        return $this->success(compact('list'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name')
        ];
        $role = Role::create($request->all());
        $role->givePermissionTo($request->input('permissions'));
        return $this->success(['id'=>$role->id]);
    }

    public function show($id)
    {
        $role = Role::findById($id);
        $data = $role->toArray();
        $data['permissions'] = $role->getAllPermissions()->pluck('id');
        return $this->success($data);
    }

    public function update(Request $request,$id)
    {
        Role::findOrFail($id)->update($request->all());
        $role = Role::findById($id);
        $has = $role->getAllPermissions()->toArray();
        foreach($has as $h){
            if(!in_array($h['name'],$request->input('permissions'))){
                $role->revokePermissionTo($h['name']);
            }
        }
        $res = $role->givePermissionTo($request->input('permissions'));
        return $this->success($res);
    }

    public function destroy($id)
    {
        $res = Role::find($id)->delete();
        return $this->success($res);
    }

    public function forceDelete($id)
    {
        $res = Role::find($id)->forceDelete();
        return $this->success($res);
    }
}
