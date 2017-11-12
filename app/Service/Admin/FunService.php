<?php
namespace App\Service\Admin;
use ReflectionClass,ReflectionMethod;
/**
 * 获取方法列表
 * User: youxu
 * Date: 2017/8/23
 * Time: 下午2:38
 */
class FunService{

    /**
     * 不展示在列表中的方法
     * @var array
     */
    protected $not_in_methods = [
        '__construct'
    ];

    /**
     * 获得方法列表
     * @param $class_name
     * @return array|bool
     */
    public function getReflectionClass($class_name){
        $reflector = new ReflectionClass(app($class_name));
        if($reflector){
            $methods_list = $reflector->getMethods(ReflectionMethod::IS_PUBLIC);
            $returnArr = [];
            foreach ($methods_list as $v){
                if($class_name == $v->class && !in_array($v->name,$this->not_in_methods)){
                    array_push($returnArr,$v->name);
                }
            }
            return $returnArr;
        }
        else{
            return false;
        }
    }
}