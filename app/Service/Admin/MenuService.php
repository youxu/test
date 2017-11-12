<?php
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/8/3
 * Time: 下午5:34
 */
namespace App\Service\Admin;
use App\Repositories\Contracts\Admin\ControRepository;
use Exception,DB;
class MenuService{

    protected $menu;
    protected $validator;
    protected $arr = [];

    public function __construct(ControRepository $menu)
    {
        $this->menu = $menu;

    }

    /**
     * 获取菜单列表
     * @return array|string
     */
    public function getMenuList(){
//        if(cache()->has(config('admin.global.cache.menuList'))){
//            return cache()->get(config('admin.global.cache.menuList'));
//        }
        return $this->sortMenuSetCache();
    }
    /**
     * 根据菜单ID查找数据
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function findMenuById($id)
    {
        $menu = $this->menu->find($id);
        if ($menu){
            return $menu;
        }
        else{
            // TODO替换正查找不到数据错误页面
            abort(404);
        }
    }

    /**
     * 排序子菜单并返回
     * @return array|string
     */
    public function sortMenuSetCache(){
        $menus = $this->menu->allMenus();
        if($menus){
            $menuList = $this->sortMenu($menus);
            foreach ($menuList as $key => &$v){
                if ($v['child']) {
                    $sort = array_column($v['child'], 'order_num');
                    array_multisort($sort,SORT_DESC,$v['child']);
                }
            }
            //添加缓存
            cache()->forever(config('admin.global.cache.menuList'),$menuList);
            return $menuList;
        }
    }

    /**
     * 删除菜单
     * @param $id
     * @return mixed
     */
    public function destoryMenu($id){
        try{
            $result = $this->menu->delete($id);
            if($this->menu){
                //更新缓存
                $this->sortMenuSetCache();
                $msg = trans('admin/alert.menu.destroy_success');
            }
            else{
                $msg = trans('admin/alert.menu.destroy_error');
            }
            flash($msg);
            return $result;
        }
        catch (Exception $exception){

        }
    }

    /**
     * 递归菜单数据
     * @param  [type]                   $menus [数据库或缓存中查询出来的数据]
     * @param  integer                  $pid   [菜单关系id]
     * @return [type]                          [description]
     */
    public function sortMenu($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['controller_id'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortMenu($menus,$v['id']);
            }
        }
        return $arr;
    }

    /**
     * 添加菜单
     * @param $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function storeMenu($request){
        try {
            $result = $this->menu->create($request->all());
            if($result){
                //更新缓存
                $this->sortMenuSetCache();
            }
            return $response = [
                'status' => $result,
                'message' => $result ? trans('admin/alert.menu.create_success'):trans('admin/alert.menu.create_error'),
            ];

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => trans('admin/alert.menu.create_error'),
            ];
        }
    }

    /**
     * 更新菜单
     * @param $request
     * @param $id
     * @return array
     */
    public function updateMenu($request,$id){
        // 防止用户恶意修改表单id，如果id不一致直接跳转500
        if ($request['id'] != $id) {
            return [
                'status' => false,
                'message' => trans('admin/errors.user_error'),
            ];
        }
        try {
            $result = $this->menu->update($request->all(),$id);
            if($result){
                //更新缓存
                $this->sortMenuSetCache();
            }
            flash()->overlay(trans('admin/alert.menu.edit_success'), trans('admin/action.message_title'));
            return redirect('admin/menu');
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => trans('admin/alert.menu.edit_error'),
            ];
        }
    }
    public function orderable($nestableData)
    {
        try {
            $dataArray = json_decode($nestableData,true);
            $menus = array_values($this->getMenuList());
            $menuCount = count($dataArray);
            $bool = false;
            DB::beginTransaction();

            foreach ($dataArray as $k => $v) {
                $sort = $menuCount - $k;
                if (!isset($menus[$k])) {
                    $this->menu->update(['sort' => $sort,'pid' => 0],$v['id']);
                    $bool = true;
                }else{
                    if (isset($menus[$k]['id']) && $v['id'] != $menus[$k]['id']) {
                        $this->menu->update(['sort' => $sort,'pid' => 0],$v['id']);
                        $bool = true;
                    }
                }
                if (isset($v['children']) && !empty($v['children'])) {
                    $childCount = count($v['children']);
                    foreach ($v['children'] as $key => $child) {
                        $chidlSort = $childCount - $key;
                        if (!isset($menus[$k]['child'][$key])) {
                            foreach ($v['children'] as $index => $val) {
                                $reIndex = $childCount - $index;
                                $this->menu->update(['pid' => $v['id'],'sort' => $reIndex],$val['id']);
                            }
                            $bool = true;
                        }else{
                            if (isset($menus[$k]['child'][$key]) && ($child['id'] != $menus[$k]['child'][$key]['id'])) {
                                $this->menu->update(['pid' => $v['id'],'sort' => $chidlSort],$child['id']);
                                $bool = true;
                            }
                        }
                    }
                }
            }
            DB::commit();
            if ($bool) {
                // 更新缓存
                $this->sortMenuSetCache();
            }
            return [
                'status' => $bool,
                'message' => $bool ? trans('admin/alert.menu.order_success'):trans('admin/alert.menu.order_error')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}