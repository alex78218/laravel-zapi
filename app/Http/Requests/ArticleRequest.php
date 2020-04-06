<?php

namespace App\Http\Requests;

class ArticleRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'         => 'required',
            'category_id'   => 'required|integer',
            'tag_ids'       => 'nullable|array',
            'content'       => 'string'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'        => '标题不能为空',
            'category_id.required'  => '分类不能为空',
            'category_id.integer'   => '分类id必须是数字',
            'tag_ids.array'         => '标签格式错误',
            'content.string'        => '内容格式错误'
        ];
    }
}
