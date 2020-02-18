<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $list = Category::where([])
            ->orderBy('parent_id','asc')
            ->orderBy('sort','asc')
            ->orderBy('id','asc')
            ->get();

        $list = listToTree($list->toArray());
        return $this->success(compact('list'));
    }

    public function store(Request $request)
    {
        $data = Category::create($request->all());
        return $this->success(['id'=>$data['id']]);
    }

    public function show($id)
    {
        $data = Category::findOrFail($id);
        return $this->success($data);
    }

    public function update(Request $request,$id)
    {
        $res = Category::withTrashed()->find($id)->update($request->all());
        return $this->success($res);
    }

    public function destroy($id)
    {
        $res = Category::find($id)->delete();
        return $this->success($res);
    }

    public function forceDelete($id)
    {
        $res = Category::withTrashed()->find($id)->forceDelete();
        return $this->success($res);
    }
}