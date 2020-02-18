<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        if($request->keyword){
            $where[] = ['title','like','%{$request->keyword}%'];
        }
        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');
        $perPage    = $request->input('per_page');

        $paginator = Article::withTrashed()
                ->where($where)
                ->with(['category','tags'])
                ->orderBy($orderField,$orderType)
                ->paginate($perPage);

        return $this->pageData($paginator);
    }

    public function store(Request $request,ArticleTag $articleTagModel)
    {
        $article = Article::create($request->all());
        if($article && $request->tag_ids){
            $articleTagModel->addTagIds($article->id,$request->tag_ids);
        }
        return $this->success(['id'=>$article->id]);
    }

    public function show($id)
    {
        $data = Article::with('category')->findOrFail($id);
        return $this->success($data);
    }

    public function update(Request $request,ArticleTag $articleTagModel,$id)
    {
        $res = Article::withTrashed()->find($id)->update($request->except('tag_ids'));
        if($res){
            ArticleTag::where('article_id',$id)->forceDelete();
            if($request->tag_ids){
                $articleTagModel->addTagIds($id,$request->tag_ids);
            }
        }
        return $this->success($res);
    }

    public function destroy($id)
    {
        $res = Article::find($id)->delete();
        return $this->success($res);
    }

    public function forceDelete($id)
    {
        $res = Article::withTrashed()->find($id)->forceDelete();
        return $this->success($res);
    }
}
