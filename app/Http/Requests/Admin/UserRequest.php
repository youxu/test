<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules['name'] = 'required|string|max:255';
        $rules['role'] = 'required';

        if (!request()->isMethod('PUT')) {
            $rules['password'] = 'required|string|min:6|confirmed';
            $rules['password_confirmation'] = 'required';
            $rules['email'] = 'required|string|email|max:255|unique:user';
//            $rules['email'] = ['required|string|email|max:255',Rule::unique('users')->ignore($id)];
        }
        else{
            $id = $this->route('user');
            $rules['email'] = [
                'required',
                'string',
                'email',
                Rule::unique('user')->ignore($id)
            ];
        }
        return $rules;
    }
    /**
     * 对应提示信息
     * @return array
     */
    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
            'numeric'   => trans('validation.numeric'),
            'string'   => trans('validation.string'),
            'max'   => trans('validation.max'),
        ];
    }
    /**
     * 字段名称
     * @return [type]                   [description]
     */
    public function attributes()
    {
        return [
            'name'      => trans('admin/user.model.name'),
            'email'       => trans('admin/user.model.email'),
            'password'      => trans('admin/user.model.password'),
            're_password'        => trans('admin/user.model.password_confirmation'),
            'role'        => trans('admin/user.model.role'),
        ];
    }
}
