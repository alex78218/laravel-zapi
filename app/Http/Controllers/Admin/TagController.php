<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{

    public function index(Request $request)
    {
        $where = [];
        $kw = $request->input('kw');
        $kw && $where[] = ['tagname','like',"%{$kw}%"];

        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');
        $perPage    = $request->input('per_page');

        $paginator = Tag::withoutTrashed()
            ->where($where)
            ->orderBy($orderField,$orderType)
            ->paginate($perPage);

        return $this->pageData($paginator);
    }

    public function all()
    {
        $list = Tag::where([])
            ->orderBy('id','asc')
            ->get()
            ->toArray();

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

    public function update(Request $request,$id)
    {
        $res = Tag::withTrashed()->find($id)->update($request->all());
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
