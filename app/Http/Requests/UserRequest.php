<?php

namespace App\Http\Requests;

class UserRequest extends BaseRequest
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
            'name'     => 'required|between:2,16|unique:users,name,'.$id,
            'email'    => 'sometimes|nullable|email|unique:users,email,'.$id,
            'role_ids' => 'nullable|array',
            'password' => $id ? 'sometimes|nullable|between:6,16' : 'required|between:6,16'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'     => '用户名不能为空',
            'name.between'      => '用户名长度为2-16字符',
            'name.unique'       => '用户名已存在99',
            'email.email'       => '邮箱格式错误',
            'email.unique'      => '邮箱已存在',
            'role_ids.array'    => '角色参数错误',
            'password.required' => '密码不能为空',
            'password.between'  => '密码长度为6-16字符'
        ];
    }
}
