<?php
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/8/17
 * Time: 上午11:29
 */
if (!function_exists('is_checked')) {
    /**
     * 是否需要选中状态
     * @param $status
     * @param $value
     * @return string
     */
    function is_checked($status,$value)
    {
        if($status  == $value){
            return 'checked="checked"';
        }
        else{
            return '';
        }
    }
}
if (!function_exists('status_change')) {
    /**
     * 状态显示
     * @param $status
     * @param $value
     * @return string
     */
    function status_change($status,$status_arr)
    {
        if(!is_array($status_arr)){
            return false;
        }
        return $status_arr[$status];
    }
}