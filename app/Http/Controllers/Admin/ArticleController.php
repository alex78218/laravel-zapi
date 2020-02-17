<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');
        $perPage    = $request->input('per_page');

        $paginator = Article::where($where)->orderBy($orderField,$orderType)->paginate($perPage);
        return $this->success($this->pageData($paginator));
    }


    /**
     * 创建
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Article::create($request->all());
        return $this->success(['id'=>$data['id']]);
    }

    /**
     * 详情
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Article::findOrFail($request->id);
        return $this->success($data);
    }

    /**
     * 更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $res = Article::where('id',$request->id)->update($request->all());
        return $this->success($res);
    }

    /**
     * 删除
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $res = Article::find($request->id)->delete();
        return $this->success($res);
    }
}
