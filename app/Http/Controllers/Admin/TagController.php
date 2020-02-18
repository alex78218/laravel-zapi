<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        if($request->keyword){
            $where[] = ['tagname','like','%{$request->keyword}%'];
        }
        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');

        $list = Tag::where($where)->orderBy($orderField,$orderType)->get()->toArray();
        return $this->success(compact('list'));
    }


    public function store(Request $request)
    {

        $data = Tag::create($request->all());
        return $this->success(['id'=>$data['id']]);
    }

    public function show($id)
    {
        $data = Tag::findOrFail($id);
        return $this->success($data);
    }


    public function update($id)
    {
        $res = Tag::where('id',$id)->update($request->all());
        return $this->success($res);
    }


    public function destroy($id)
    {
        $res = Tag::find($id)->delete();
        return $this->success($res);
    }

    public function forceDelete($id)
    {
        $res = Tag::withTrashed()->find($id)->forceDelete();
        return $this->success($res);
    }
}
