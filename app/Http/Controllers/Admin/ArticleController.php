<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        $kw = $request->input('kw');
        $kw && $where[] = ['title','like',"%{$kw}%"];

        $orderField = $request->input('order_field','id');
        $orderType  = $request->input('order_type','desc');
        $perPage    = $request->input('per_page');

        $paginator = Article::withoutTrashed()
                ->where($where)
                ->with(['category','tags'])
                ->orderBy($orderField,$orderType)
                ->paginate($perPage);

        return $this->pageData($paginator);
    }

    public function store(ArticleRequest $request,ArticleTag $articleTagModel)
    {
        $article = Article::create($request->all());
        if($article && $request->input('tag_ids')){
            $articleTagModel->addTagIds($article->id,$request->input('tag_ids'));
        }
        return $this->success(['id'=>$article->id]);
    }

    public function show($id)
    {
        $data = Article::with(['category','tags'])->findOrFail($id);
        return $this->success($data);
    }

    public function update(ArticleRequest $request,ArticleTag $articleTagModel,$id)
    {
        $res = Article::withTrashed()->find($id)->update($request->except('tag_ids'));
        if($res){
            ArticleTag::where('article_id',$id)->forceDelete();
            if($request->input('tag_ids')){
                $articleTagModel->addTagIds($id,$request->input('tag_ids'));
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
