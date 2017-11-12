<?php

namespace App\Presenters\Admin;

use App\Repositories\Transformers\Admin\RoleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RolePresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class RolePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoleTransformer();
    }
    /**
     * 列表
     * @param $list
     * @return string
     */
    public function getRoleList($list){
        $html = '';
        foreach ($list as $k=>$v){
            $html .= <<<Eof
		        <tr>
                    <td>{$v->id}</td>
                    <td>{$v->name}</td>
                    <td>{$v->display_name}</td>
                    <td>{$v->description}</td>
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
        $action .= '<a href="'.url('admin/role/'.$id.'/edit').'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.edit').'" data-placement="top"><i class="fa fa-edit"></i></a>';
        $action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="4" data-original-title="'.trans('admin/action.actionButton.destroy').'" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i>
            <form action="'.url('admin/role',[$id]).'" method="POST" style="display:none">
            <input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form>
            </a>';
        $action .= '</div>';
        return $action;
        ;
    }
}
