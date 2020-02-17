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

    public function show(Request $request)
    {
        $data = Tag::findOrFail($request->id);
        return $this->success($data);
    }


    public function update(Request $request)
    {
        $res = Tag::where('id',$request->id)->update($request->all());
        return $this->success($res);
    }


    public function destroy(Request $request)
    {
        $res = Tag::find($request->id)->delete();
        return $this->success($res);
    }
}
