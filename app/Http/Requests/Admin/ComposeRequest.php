<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ComposeRequest extends FormRequest
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
        $rules['cn_name'] = 'required';
        $rules['en_name'] = 'required';
        // 添加权限(针对更新)
        if (request()->isMethod('PUT') || request()->isMethod('PATH')) {
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['id'] = 'numeric|required';
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
        ];
    }
    /**
     * 字段名称
     * @return [type]                   [description]
     */
    public function attributes()
    {
        return [
            'cn_name'      => trans('admin/compose.model.cn_name'),
            'en_name'       => trans('admin/compose.model.en_name'),
            'order_num'      => trans('admin/compose.model.order_num'),
            'is_show'      => trans('admin/compose.model.is_show'),
            'status'      => trans('admin/compose.model.status'),
            'id'        => trans('admin/compose.model.id'),
        ];
    }

}
