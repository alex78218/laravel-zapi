<?php

namespace App\Http\Requests;

class RoleRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => 'required',
            'remark'        => 'nullable',
            'permissions'   => 'sometimes|nullable|array'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'     => '角色名不能为空',
            'permission.array'  => '权限必须为数组'
        ];
    }
}
