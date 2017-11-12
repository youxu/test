<?php
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/8/3
 * Time: 下午5:34
 */
namespace App\Service\Admin;
use App\Repositories\Contracts\Admin\RoleRepository;
use App\Repositories\Contracts\Admin\ControRepository;
use App\Repositories\Contracts\Admin\PermissionRepository;
class RoleService{
    public $RoleRepository;
    protected $ControRepository;
    protected $PermissionRepository;
    public function __construct(RoleRepository $RoleRepository,ControRepository $ControRepository,PermissionRepository $PermissionRepository)
    {
        $this->RoleRepository = $RoleRepository;
        $this->ControRepository = $ControRepository;
        $this->PermissionRepository = $PermissionRepository;
    }

    /**
     * 获取权限列表
     * @return array|string
     */
    public function getRoleList(){
        $roles = $this->ControRepository->orderBy('order_num')->findWhere(['is_right' => 1])->toArray();
        if($roles){
            $roleList = $this->sortRole($roles);
            foreach ($roleList as $key => &$v){
                if ($v['child']) {
                    $sort = array_column($v['child'], 'order_num');
                    array_multisort($sort,SORT_DESC,$v['child']);
                }
            }
            return $roleList;
        }
    }

    /**
     * 通过角色id获取权限
     * @param $role_id
     * @return array
     */
    public function getRolePermissionByRoleId($role_id){
        $RolePermission = $this->RoleRepository->getPermissionRole($role_id)->toArray();
        $RolePermission = array_dot($RolePermission);//二维数组转换成一维数组

        return $RolePermission;
    }
    /**
     * 递归权限列表数据
     * @param  [type]                   $role [数据库或缓存中查询出来的数据]
     * @param  integer                  $controller_id   [控制器关系id]
     * @return [type]                          [description]
     */
    public function sortRole($role,$controller_id=0)
    {
        $arr = [];
        if (empty($role)) {
            return '';
        }
        foreach ($role as $key => $v) {
            if ($v['controller_id'] == $controller_id) {
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortRole($role,$v['id']);
            }
        }
        return $arr;
    }

    /**
     * 填加角色
     * @param $request
     * @return mixed
     */
    public function stroeRole($request){
        $role = $this->RoleRepository->create($request->all());
        //填加权限
        if($request->permissions){
            $role->perms()->sync($request->permissions);
        }
        return $role;
    }

    /**
     * 更新
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateRole($request,$id){
        $role = $this->RoleRepository->update($request->all(),$id);
        //填加权限
        if($request->permissions){
            $role->perms()->sync($request->permissions);
        }
        return $role;
    }

    /**
     * 删除角色
     * @param $id
     * @return int
     */
    public function deleteRole($id){
        $role = $this->RoleRepository->find($id);
        $deleted = $this->RoleRepository->delete($id);
        if($deleted){
            $role->perms()->sync([]);
        }
        return $deleted;
    }


}