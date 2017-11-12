<?php
namespace App\Service\Admin;
use App\Repositories\Contracts\Admin\ComposeRepository;
use App\Repositories\Criteria\FilterStatusComposeCriteria;
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/8/15
 * Time: 下午4:11
 */
class ComposeService{
    public $compose;
    public function __construct(ComposeRepository $compose)
    {
        $this->compose = $compose;
    }
    public function getList(){
//        $this->compose->pushCriteria(new FilterStatusComposeCriteria(1));
        $list = $this->compose->orderBy('order_num','desc')->skipPresenter()->paginate(trans('admin/compose.pageNum'));
        return $list;
    }

    /**
     * 添加
     * @param $request
     * @return bool
     */
    public function  stroeCompose($request){
        try{
            $res = $this->compose->create($request->all());
            if ($res){
                flash()->overlay(trans('admin/alert.compose.create_success'), trans('admin/action.message_title'));
            }
            else{
                flash()->overlay(trans('admin/alert.compose.create_error'), trans('admin/action.message_title'));
            }
            return true;
        }
        catch (\Exception $e){
            flash()->overlay(trans('admin/alert.compose.create_error'), trans('admin/action.message_title'));
            return false;
        }
    }

    public function updateCompose($request,$id){
        try{
            $res = $this->compose->update($request->all(),$id);
            if ($res){
                flash()->overlay(trans('admin/alert.compose.edit_success'), trans('admin/action.message_title'));
            }
            else{
                flash()->overlay(trans('admin/alert.compose.edit_error'), trans('admin/action.message_title'));
            }
            return true;
        }
        catch (\Exception $e){
            flash()->overlay(trans('admin/alert.compose.edit_error'), trans('admin/action.message_title'));
            return false;
        }
    }

    public function destroyCompose($id){
        try{
            $param['status'] = 0;
            $res = $this->compose->update($param,$id);
            if ($res){
                flash()->overlay(trans('admin/alert.compose.destroy_success'), trans('admin/action.message_title'));
            }
            else{
                flash()->overlay(trans('admin/alert.compose.destroy_error'), trans('admin/action.message_title'));
            }
            return true;
        }
        catch(\Exception $e){
            flash()->overlay(trans('admin/alert.compose.destroy_error'), trans('admin/action.message_title'));
            return false;
        }
    }

}