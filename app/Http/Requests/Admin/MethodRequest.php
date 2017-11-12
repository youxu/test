<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class MethodRequest extends FormRequest
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
        $rules['update.*.func_name_cn'] = 'required';
        $rules['update.*.id'] = 'numeric|required';
        return $rules;
    }

    /**
     * 对应提示信息
     * @return array
     */
    public function messages()
    {
        return [
            'required' => trans('validation.required'),
            'numeric' => trans('validation.numeric'),
        ];
    }

    /**
     * 字段名称
     * @return [type]                   [description]
     */
    public function attributes()
    {
        return [
            'id' => trans('admin/contro.model.id'),
            'compose_id' => trans('admin/contro.model.compose_id'),
            'controller_id' => trans('admin/contro.model.controller_id'),
            'func_name' => trans('admin/contro.model.func_name'),
            'func_name_cn' => trans('admin/contro.model.func_name_cn'),
            'update.*.func_name_cn' => trans('admin/contro.model.func_name_cn'),
            'is_menu' => trans('admin/contro.model.is_menu'),
            'is_right' => trans('admin/contro.model.is_right'),
            'order_num' => trans('admin/contro.model.order_num'),
            'icon' => trans('admin/contro.model.icon'),
        ];
    }
}
