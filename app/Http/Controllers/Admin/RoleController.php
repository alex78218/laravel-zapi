<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as PermissionRole;

class RoleController extends Controller
{
    public function __construct()
    {
        app()->cache->forget('spatie.permission.cache');
    }

    public function test(User $userModel)
    {
        $routes = app()->routes->getRoutes();
        //var_dump($routes->toArray());
        $list = [];
        foreach($routes as $k=>$v){
            $arr = explode('/',$v->uri);
            if($arr[0]=='api'){
                $list[$k]['url'] = $v->uri;
                $list[$k]['path'] = $v->methods[0];
                $list[$k]['name'] = $v->getName();
            }
        }
        dd($list);
        $list = [];
        foreach($routes as $k=>$v){
            $list[$k]['url'] = $v->uri;
            $list[$k]['path'] = $v->methods[0];
            $list[$k]['name'] = $v->getName();
        }
        var_dump($list);
        die();
        $role = Role::create(['name'=>'editor','guard_name'=>'api']);
        //$permission = Permission::create(['name'=>'edit article']);
        $user = $userModel::find(10);
  //      auth()->login($user);
//        $user = auth()->user();
        $user->givePermissionTo('edit article');
        $user->assignRole('admin');

        //$role = Role::find(1); Role::
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

        $paginator = User::where($where)
            ->orderBy($orderField,$orderType)
            ->paginate($perPage);

        return $this->pageData($paginator);
    }

    public function store(Request $request,ArticleTag $articleTagModel)
    {
        $role = PermissionRole::create($request->all());
        $role->givePermissionTo($request->permissions);
        return $this->success(['id'=>$role->id]);
    }

    public function show($id)
    {
        $data = Role::findOrFail($id);
        return $this->success($data);
    }

    public function update(Request $request,$id)
    {
        $role = PermissionRole::findById($request->id);
        $has = $role->getAllPermissions()->toArray();
        foreach($has as $h){
            if(!in_array($h['name'],$request->permissions)){
                $role->revokePermissionTo($h['name']);
            }
        }
        $res = $role->givePermissionTo($request->permissions);
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
