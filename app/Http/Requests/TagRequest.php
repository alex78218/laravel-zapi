<?php

namespace App\Http\Requests;

class TagRequest extends BaseRequest
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
            'tagname'  => 'required|unique:tags,tagname,'.$id,
            'sort'     => 'sometimes|integer'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'tagname.required'  => '标签名不能为空',
            'tagname.unique'    => '标签名已存在',
            'sort.integer'         => '排序必须为数字'
        ];
    }
}
