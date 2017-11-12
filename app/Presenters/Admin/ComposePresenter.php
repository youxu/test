<?php

namespace App\Presenters\Admin;

use App\Repositories\Transformers\Admin\ComposeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ComposePresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class ComposePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ComposeTransformer();
    }
    /**
     * 列表
     * @param $list
     * @return string
     */
    public function getComposeList($list){
        $html = '';
        foreach ($list as $k=>$v){
            $html .= <<<Eof
		        <tr>
                    <td>{$v->id}</td>
                    <td>{$v->cn_name}</td>
                    <td>{$v->en_name}</td>
                    <td>{$v->status}</td>
                    <td>{$v->is_show}</td>
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
        $action .= '<a href="'.url('admin/contro/index/'.$id).'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.edit').'" data-placement="top">控制器列表</a>';
        $action .= '<a href="'.url('admin/contro/create/'.$id).'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.edit').'" data-placement="top"><i class="fa  fa-plus-square"></i></a>';
        $action .= '<a href="'.url('admin/compose/'.$id.'/edit').'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.edit').'" data-placement="top"><i class="fa fa-edit"></i></a>';

        $action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="4" data-original-title="'.trans('admin/action.actionButton.destroy').'" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i>
            <form action="'.url('admin/compose',[$id]).'" method="POST" style="display:none">
            <input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form>
            </a>';
        $action .= '</div>';
        return $action;
;
    }

}
