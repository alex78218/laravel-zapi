<?php

namespace App\Http\Controllers\Admin;

use App\Es\Article as EsArticle;
use Illuminate\Http\Request;
use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as PermissionRole;

class TestController extends BaseController
{

    public function index(Request $request)
    {
        echo config('app.url');
        echo env('APP_URL');

        //echo 111;die();
        //$es = new EsArticle();
        //$es->get();
        //$es->createIndex();
        //$es->store();
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


}
