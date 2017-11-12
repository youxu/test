<?php

namespace App\Presenters\Admin;

use App\Repositories\Transformers\Admin\MenuTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use Illuminate\Support\Facades\Route;

/**
 * Class MenuPresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class MenuPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MenuTransformer();
    }
    public function menuNestable($menus)
    {
        if ($menus) {
            $item = '';
            foreach ($menus as $v) {
                $item.= $this->getNestableItem($v);
            }
            return $item;
        }
        return '暂无菜单';
    }
    /**
     * 返回菜单HTML代码
     * @param  [type]                   $menu [description]
     * @return [type]                         [description]
     */
    protected function getNestableItem($menu)
    {
        if ($menu['child']) {
            return $this->getHandleList($menu['id'],$menu['func_name_cn'],$menu['icon'],$menu['child']);
        }
        $labelInfo = $menu['controller_id'] == 0 ?  'label-info':'label-warning';
        return <<<Eof
				<li class="dd-item dd3-item" data-id="{$menu['id']}">
                    <div class="dd-handle dd3-handle">Drag</div>
                    <div class="dd3-content"><span class="label {$labelInfo}"><i class="fa {$menu['icon']}"></i></span> {$menu['func_name_cn']} {$this->getActionButtons($menu['id'])}</div>
                    <div id="showinfo_{$menu['id']}" style="display: none"></div>
                </li>
Eof;
    }
    /**
     * 判断是否有子集
     * @param  [type]                   $id    [description]
     * @param  [type]                   $name  [description]
     * @param  [type]                   $child [description]
     * @return [type]                          [description]
     */
    protected function getHandleList($id,$name,$icon,$child)
    {
        $handle = '';
        if ($child) {
            foreach ($child as $v) {
                $handle .= $this->getNestableItem($v);
            }
        }

        $html = <<<Eof
		<li class="dd-item dd3-item" data-id="{$id}">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content">
            	<span class="label label-info"><i class="fa {$icon}"></i></span> {$name} {$this->getActionButtons($id)}
            </div>
            <div id="showinfo_{$id}" style="display: none"></div>
            <ol class="dd-list">
                {$handle}
            </ol>
        </li>
Eof;
        return $html;
    }
    /**
     * 菜单按钮
     * @param  [type]                   $id   [description]
     * @param  boolean                  $bool [description]
     * @return [type]                         [description]
     */
    protected function getActionButtons($id)
    {
        $action = '<div class="pull-right">';
//        if (auth()->user()->can(config('admin.permissions.menu.show'))) {
//            $action .= '<a href="javascript:;" class="btn btn-xs tooltips showInfo" data-href="'.url('admin/menu',[$id]).'" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.show').'"  data-placement="top"><i class="fa fa-eye"></i></a>';
//        }
//        if (auth()->user()->can(config('admin.permissions.menu.edit'))) {
//            $action .= '<a href="javascript:;" data-href="'.url('admin/menu/'.$id.'/edit').'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip"data-original-title="'.trans('admin/action.actionButton.edit').'"  data-placement="top"><i class="fa fa-edit"></i></a>';
//        }
//        if (auth()->user()->can(config('admin.permissions.menu.destroy'))) {
//            $action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="'.$id.'" data-original-title="'.trans('admin/action.actionButton.destroy').'"data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash"></i><form action="'.url('admin/menu',[$id]).'" method="POST" style="display:none"><input type="hidden"name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
//        }
        $action .= '<a href="javascript:;" data-href = "'.url('admin/menu',[$id]).'" data-id="'.$id.'" class="btn btn-xs tooltips showInfo"  data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.show').'"  data-placement="top"><i class="fa fa-eye"></i></a>';
        $action .= '<a href="'.url('admin/menu/'.$id.'/edit').'"  class="btn btn-xs tooltips editMenu" data-toggle="tooltip"data-original-title="'.trans('admin/action.actionButton.edit').'"  data-placement="top"><i class="fa fa-edit"></i></a>';
        $action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="'.$id.'" data-original-title="'.trans('admin/action.actionButton.destroy').'"data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash"></i><form action="'.url('admin/menu',[$id]).'" method="POST" style="display:none"><input type="hidden"name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
        $action .= '</div>';
        return $action;
    }
    /**
     * 菜单树
     * @param $menus
     * @param string $pid
     * @return string
     */
    public function topMenuList($menus,$pid = ''){
        $html = '<option value="0">'.trans('admin/menu.topMenu').'</option>';
        if ($menus) {
            foreach ($menus as $v) {
                $html .= '<option value="'.$v['id'].'" '.$this->checkMenu($v['id'],$pid).'>'.$v['name'].'</option>';
            }
        }
        return $html;
    }
    /**
     * 获取菜单关系名称
     * @param  [type]     $menus [所有菜单数据]
     * @param  [type]     $pid   [菜单关系pid]
     * @return [type]            [description]
     */
    public function topMenuName($menus,$pid)
    {
        if ($pid == 0) {
            return '顶级菜单';
        }
        if ($menus) {
            foreach ($menus as $v) {
                if ($v['id'] == $pid) {
                    return $v['name'];
                }
            }
        }
        return '';
    }

    /**
     * 获得左侧菜单树
     * （支持两级）
     */
    public function sidebarMenuList($sidebarMenus)
    {
        $html = '';
        if ($sidebarMenus) {
            foreach ($sidebarMenus as $menu) {
//                if (!auth()->user()->can($menu['slug'])) {
//                    continue;
//                }
                if ($menu['child']) {
                    $active = active_class(if_uri_pattern(explode(',',$menu['active'])),'active');
                    $url = url($menu['url']);
                    $html .= <<<Eof
					<li class="treeview {$active}">
			          	<a href="#"><i class=" fa {$menu['icon']}"></i> <span class="nav-label">{$menu['func_name_cn']}</span> <span class="fa fa-angle-left pull-right"></span></a>
			          	<ul class="treeview-menu">
			              	{$this->childMenu($menu['child'])}
			          	</ul>
			      	</li>
Eof;
                }else{
                    $html .= '<li class="'.active_class(if_uri_pattern(explode(',',$menu['active'])),'active').'"><a href="'.url($menu['url']).'"><i class="fa '.$menu['icon'].'"></i> <span class="nav-label">'.$menu['func_name_cn'].'</span></a></li>';
                }
            }
        }
        return $html;
    }

    public function checkMenu($menuId,$pid)
    {
        if ($pid !== '') {
            if ($menuId == $pid) {
                return 'selected="selected"';
            }
            return '';
        }
        return '';
    }
    /**
     * 多级菜单显示
     * @param  [type]     $childMenu [子菜单数据]
     * @return [type]                [HTML]
     */
    public function childMenu($childMenu)
    {
        $html = '';
        if ($childMenu) {
            foreach ($childMenu as $v) {
                $icon = $v['icon'] ? '<i class="fa '.$v['icon'].'"></i>':'';
                $html .= '<li class="'.active_class(if_uri_pattern(explode(',',$v['active'])),'active').'"><a href="'.url($v['url']).'">'.$icon.$v['func_name_cn'].'</a></li>';
            }
        }
        return $html;
    }
}
