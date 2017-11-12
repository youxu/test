<?php
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/7/14
 * Time: 上午11:50
 */
namespace App\http\Repositories;
use App\User;
class UserRepository {
    /**
     * 获取所有用户
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function selectAll(){
        return User::all();
    }

    /**
     * 获取用户详情
     * @param $id
     * @return mixed
     */
    public function getUserInfo($id){
        return User::find($id);
    }
}