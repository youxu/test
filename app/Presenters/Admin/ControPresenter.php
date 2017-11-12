<?php

namespace App\Presenters\Admin;

use App\Repositories\Transformers\Admin\ControTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\Contracts\Admin\ComposeRepository;

/**
 * Class ControPresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class ControPresenter extends FractalPresenter
{
    protected $compose;
    public function __construct(ComposeRepository $compose)
    {
        $this->compose = $compose;
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ControTransformer();
    }

    /**
     * 获取组件列表
     * @param $list
     * @return string
     */
    public function getComposeSelect($list,$id = ''){
        $html = "<select class=\"form-control\" id='compose_id' name='compose_id'>";
        foreach ($list as $v){
            $checked = '';
            if(!empty($id)){
                $checked = is_checked($v->id,$id);
            }
            $html .= "<option value='{$v->id}' {$checked}>{$v->cn_name}</option>";
        }
        $html .= "</select>";
        return $html;
    }

    public function getControllerList($list){
        $html = '';
        foreach ($list as $k=>$v){
            $status_cn = status_change($v->is_menu,trans('admin/action.status_arr'));
            $right_cn = status_change($v->is_right,trans('admin/action.status_arr'));
            $compose = $this->compose->find($v->compose_id);
            $html .= <<<Eof
		        <tr>
                    <td>{$v->id}</td>
                    <td>{$compose->en_name}</td>
                    <td>{$v->func_name}</td>
                    <td>{$v->func_name_cn}</td>
                    <td>{$status_cn}</td>
                    <td><span class="fa {$v->icon}"></span></td>
                    <td><span>{$this->getListAction($v->id)}</span></td>
                </tr>
Eof;
        }
        return $html;
    }
    /**
     * 操作按钮
     * @param $id
     * @return string
     */
    public function getListAction($id){
        $action = '<div>';
        $action .= '<a href="'.url('admin/contro/list_method',$id).'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.edit').'" data-placement="top">方法列表</a>';
        $action .= '<a href="'.url('admin/contro/'.$id.'/edit').'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.edit').'" data-placement="top"><i class="fa fa-edit"></i></a>';

        $action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-original-title="'.trans('admin/action.actionButton.destroy').'" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i>
            <form action="'.url('admin/contro',[$id]).'" method="POST" style="display:none">
            <input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form>
            </a>';
        $action .= '</div>';
        return $action;
        ;
    }

    public function getDbMethodList($list){
        $html = '';
        foreach ($list as $k=>$v){
            $status_cn = status_change($v->is_menu,trans('admin/action.status_arr'));
            $right_cn = status_change($v->is_right,trans('admin/action.status_arr'));
            $html .= <<<Eof
		        <tr>
                    <td>{$v->id}</td>
                    <td>{$v->func_name}</td>
                    <td><input type="text" name="func_name_cn[]" value="{$v->func_name_cn}" /></td>
                    <td>{$status_cn}</td>
                    <td>{$right_cn}</td>
                    <td>
                    <input type="text" name="icon[]" value="{$v->icon}" /><span class="fa {$v->icon}"></span>
                    <input type="hidden" name="id[]" value="{$v->id}" />
                    </td>
                </tr>
Eof;
        }
        return $html;
    }

}
