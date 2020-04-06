<?php

namespace App\Http\Requests;

class CategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id',null);
        $rules = [
            'catename'  => 'required',
            'parent_id' => 'sometimes|integer',
            'sort'      => 'sometimes|integer',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'catename.required'  => '标签名不能为空',
            'parent_id.integer'  => '父级ID必须为数字',
            'sort.integer'       => '排序必须为数字'
        ];
    }
}
