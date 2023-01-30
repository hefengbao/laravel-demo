<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 这里要改为 true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:10'],
            'email' => ['required', 'email:rfc,dns', 'unique:users']
        ];
    }

    // 自定义验证错误提示信息
    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.max' => '用户名不能超过10个字符',
            'email.required' => '邮箱不能为空',
            'email.email' => '不是有效的邮箱',
            'email.unique' => '该邮箱已注册'
        ];
    }
}
