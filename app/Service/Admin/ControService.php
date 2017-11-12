<?php
namespace App\Service\Admin;
use App\Repositories\Contracts\Admin\ControRepository;
use App\Repositories\Criteria\FilterComposeForControCriteria;
use App\Service\Admin\FunService;
use ReflectionClass;
use App\Repositories\Contracts\Admin\PermissionRepository;
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/8/15
 * Time: 下午4:11
 */
class ControService{

    public $contro;
    protected $fun;
    protected $permission;
    protected $namespace = "App\\";
    public function __construct(ControRepository $contro,FunService $fun,PermissionRepository $permission)
    {
        $this->contro = $contro;
        $this->fun = $fun;
        $this->permission = $permission;
    }

    public function getControllerList($compose_id){
        $this->contro->pushCriteria(new FilterComposeForControCriteria($compose_id));
        return $this->contro->all();
    }

    /**
     * 获得controller中的方法列表
     * @param $contro_id
     * @return array|bool
     */
    public function getMethodList($contro_id){
        if(empty($contro_id)){
            return false;
        }
        $controller_info = $this->contro->find($contro_id);
        $row_list = $this->contro->getFunctionList($contro_id);
        if($controller_info){
            $controller_class_name = "App\Http\Controllers\\{$controller_info->compose->en_name}\\{$controller_info->func_name}";
            $controller_methods = $this->fun->getReflectionClass($controller_class_name);
            if($controller_methods && is_array($controller_methods)){
                foreach ($row_list as $v){
                    foreach ($controller_methods as $key => $mv){
                        if($v->func_name == $mv){
                            unset($controller_methods[$key]);
                        }
                    }
                }
                return compact('row_list','controller_methods');
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    /**
     * 更新方法列表
     * @param $update_arr
     * @return bool
     */
    public function updateMethod($update_arr){
        if(empty($update_arr)){
            return false;
        }
        foreach ($update_arr  as $key => $value){
            //增加权限
            if(empty($value['permission_id']) && $value['is_right']){
                $permission['name'] = $value['compose_en_name'] . "-" .str_replace('Controller','',$value['controller_name']) . '-' . $value['func_name'];
                $permission['display_name'] = $value['func_name_cn'];
                $permission['description'] = $value['func_name_cn'];
                $permission_id = $this->permission->create($permission);
                $value['permission_id'] = $permission_id->id;
            }
            //删除权限
            if(!empty($value['permission_id']) && !$value['is_right']){
//                $del_id = $this->permission->find($value['permission_id']);
                $del_id = $this->permission->delete($value['permission_id']);
                if ($del_id){
                    $value['permission_id'] = null;
                }
            }
            $this->contro->update($value,$value['id']);
        }
        flash()->overlay(trans('admin/alert.contro.method_edit_success'), trans('admin/action.message_title'));
        return true;
    }

    /**
     * 新增方法
     * @param $request
     * @return bool
     */
    public function storeMethod($request){
        $create_arr = $request->create;
        $contro_id = $request->contro_id;
        $contro_info = $this->contro->find($contro_id);
        $compose_en_name = $contro_info->compose->en_name;
        $compose_id = $contro_info->compose_id;
        foreach ($create_arr as $key => $value){
            $value['compose_id'] = $compose_id;
            $value['controller_id'] = $contro_id;
            $permission['name'] = $compose_en_name . "-" .str_replace('Controller','',$contro_info->func_name) . '-' . $value['func_name'];
            $permission['display_name'] = $value['func_name_cn'];
            $permission['description'] = $value['func_name_cn'];
            $permission_id = $this->permission->create($permission);
            $value['permission_id'] = $permission_id->id;
            $this->contro->create($value);
        }
        flash()->overlay(trans('admin/alert.contro.method_edit_success'), trans('admin/action.message_title'));
        return true;
    }

    private function createPermissName(){

    }

    /**
     * 新增控制器
     * @param $request
     * @return bool|\Illuminate\Http\JsonResponse|mixed
     */
    public function storeContro($request){
        try{
            $res = $this->contro->create($request->all());
            $response = [
                'message' => trans('admin/alert.contro.create_success'),
                'data'    => $res->toArray(),
            ];
            if ($request->wantsJson()) {

                return response()->json($response);
            }
            if ($res){
                flash()->overlay(trans('admin/alert.contro.create_success'), trans('admin/action.message_title'));
            }
            else{
                flash()->overlay(trans('admin/alert.contro.create_error'), trans('admin/action.message_title'));
            }
            return $res;
        }
        catch (\Exception $e){
            flash()->overlay(trans('admin/alert.contro.create_error').$e->getMessage(), trans('admin/action.message_title'));
            return false;
        }
    }
    /**
     * 编辑控制器
     * @param $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function editContro($request,$id){
        try {
            $res = $this->contro->update($request->all(),$id);
            $response = [
                'message' => trans('admin/alert.contro.edit_success'),
                'data'    => $res->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            if ($res){
                flash()->overlay(trans('admin/alert.contro.edit_success'), trans('admin/action.message_title'));
            }
            else{
                flash()->overlay(trans('admin/alert.contro.edit_error'), trans('admin/action.message_title'));
            }
            return $res;
        } catch (\Exception $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ]);
            }
            flash()->overlay(trans('admin/alert.contro.create_error'), trans('admin/action.message_title'));
            return false;
        }
    }

    /**
     * 删除控制器
     * @param $id
     * @return bool
     */
    public function delContro($id){
        try{
            $sonController =  $this->contro->findWhere(['controller_id' => $id]);
            if($sonController){
                foreach ($sonController as $key => $value){
                    if(!empty($value->permission_id)){
                        $this->permission->delete($value->permission_id);
                    }
                    $this->contro->delete($value->id);
                }
            }
            $this->contro->delete($id);
            flash()->overlay(trans('admin/alert.contro.destroy_success'), trans('admin/action.message_title'));
            return true;
        }
        catch (\Exception $e){
            flash()->overlay(trans('admin/alert.contro.destroy_error'), trans('admin/action.message_title'));
            return false;
        }
    }
}