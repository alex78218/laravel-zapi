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
        $paginator = Article::where($where)
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

    public function show(Request $request)
    {
        //throw new ApiException(CodeEnum::ERROR_NOT_FOUND);
        $data = Article::with('category')->findOrFail($request->id);
        return $this->success($data);
    }


    public function update(Request $request,ArticleTag $articleTagModel)
    {
        $res = Article::where('id',$request->id)->update($request->except('tag_ids'));
        if($res){
            $articleTagModel::where('article_id',$request->id)->forceDelete();
            if($request->tag_ids){
                $articleTagModel->addTagIds($request->id,$request->tag_ids);
            }
        }
        return $this->success($res);
    }


    public function destroy(Request $request)
    {
        $res = Article::find($request->id)->delete();
        return $this->success($res);
    }
}
