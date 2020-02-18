<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    public function addTagIds(int $article_id,array $tag_ids)
    {
        $data = [];
        foreach($tag_ids as $tag_id){
            $data[] = [
                'article_id' => $article_id,
                'tag_id'     => $tag_id
            ];
        }
        return $this->insert($data);
    }
}
