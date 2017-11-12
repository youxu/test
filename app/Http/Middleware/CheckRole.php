<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Permission;

class CheckRole
{
    public $permissionArr = [];
    public $permission ;
    public function __construct(Permission $permission)
    {
        $this->getPrefixName();
        $this->getControllerName();
        $this->getMethodName();
        $this->permission = $permission;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $thisPermission = $this->createPermissionUrl();
        $user = Auth::user();
        //如果是超级管理员直接不需要判断权限

        if($user->hasRole('admin')){

            return $next($request);
        }
        else{
            $permissionInfo = $this->permission->where(['name' => $thisPermission])->first();
            //没建立controller方法和不设置为权限都放过
            if(empty($permissionInfo) || !$permissionInfo->contro->is_right || $user->can($thisPermission)){
                return $next($request);
            }
            flash()->overlay(trans('admin/alert.noPermission'), trans('admin/action.message_title'));

            return redirect('admin/home');
        }

    }

    public function getActionName(){
        return Route::current()->getAction();
    }

    /**
     * 获取当前url前缀
     * @return string
     */
    public function getPrefixName(){
        $action = $this->getActionName();
        $prefix = $action['prefix'];
        if(!empty($prefix)){
            $prefix = ucfirst(ltrim($prefix,'/'));
            array_push($this->permissionArr,$prefix);
        }
    }
    /**
     * 获取当前控制器
     *
     * @return array
     */
    public function getControllerName()
    {
        $action = $this->getActionName();
        $longController = Arr::first(explode('@', $action['controller']));
        $controller = Arr::last(explode('\\',$longController));

        if(!empty($controller)){
            $controller = rtrim($controller,'Controller');
            array_push($this->permissionArr,$controller);
        }
    }

    /**
     * 获取方法名
     */
    public function getMethodName(){
        array_push($this->permissionArr,Route::current()->getActionMethod());
    }

    /**
     * 创建权限完整路径
     * @return bool|string
     */
    public function createPermissionUrl(){
        if(!empty($this->permissionArr)){
            return implode($this->permissionArr,'-');
        }
        else{
            return false;
        }
    }
}
