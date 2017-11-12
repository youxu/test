<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //验证是否登录
        return true;
    }
    public function messages()
    {
        return [
            'title.required' => ':attribute不能为空',
            'title.max' => ':attribute最大不能超过:max',
            'content.required' => ':attribute不能为空',

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required|max:255',
            'content' => 'required'
        ];
    }
}
