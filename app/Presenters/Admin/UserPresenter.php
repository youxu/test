<?php

namespace App\Presenters\Admin;

use App\Repositories\Contracts\Admin\UserRoleRepository;
use App\Repositories\Transformers\Admin\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserPresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class UserPresenter extends FractalPresenter
{
    protected $userRole;
    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRole = $userRoleRepository;
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }

    /**
     * 获取用户角色
     * @param $userId
     * @return bool|mixed
     */
    public function getUserRole($userId){

        if(empty($userId)){
            return false;
        }

        return $this->userRole->findWhere(['user_id' => $userId]);
    }

    /**
     * 获取用户列表
     * @param $list
     * @return string
     */
    public function getUserList($list){
        $html = '';
        foreach ($list as $v){
            $html .= <<<Eof
		        <tr>
                    <td>{$v->id}</td>
                    <td>{$v->name}</td>
                    <td>{$v->email}</td>
                    <td>{$this->createRoleString($v->id)}</td>
                    <td><span>{$this->getListAction($v->id)}</span></td>
                </tr>
Eof;
        }
        return $html;
    }


    public function getUserRoleHtml($roleList,$user){
        $html = '';
        $roleArr = [];

        if($user->role){
            foreach ($user->role as $roleValue){
                $roleArr[] = $roleValue->role_id;
            }
        }
        foreach ($roleList as $roleListValue){
            $checked = "";
            if(in_array($roleListValue->id , $roleArr)){
                $checked = "checked = 'checked'";
            }
            $html .= "<input type=\"checkbox\" name=\"role[]\" value=\"{$roleListValue->id}\" {$checked} >{$roleListValue->display_name} &nbsp;";
        }

        return $html;
    }
    /**
     * 获取列表操作菜单
     * @param $id
     * @return string
     */
    protected function getListAction($id){
        $action = '<div>';
        $action .= '<a href="'.url('admin/user/'.$id.'/edit').'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.edit').'" data-placement="top"><i class="fa fa-edit"></i></a>';

        $action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="4" data-original-title="'.trans('admin/action.actionButton.destroy').'" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i>
            <form action="'.url('admin/user',[$id]).'" method="POST" style="display:none">
            <input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form>
            </a>';
        $action .= '</div>';
        return $action;
        ;
    }

    /**
     * 创建角色名称字符串
     * @param $userId 用户id
     * @param string $splitString 分割字符串
     * @return string
     */
    protected function createRoleString($userId,$splitString = ','){
        $roleList = $this->getUserRole($userId);
        $roleString = '';

        if($roleList){
            foreach ($roleList as $value){
                $roleString .= $value->role->display_name . $splitString;
            }
            $roleString = rtrim($roleString,$splitString);
        }

        return $roleString;
    }
}
