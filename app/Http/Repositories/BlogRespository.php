<?php
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/7/16
 * Time: 上午7:50
 */

namespace App\http\Repositories;


use App\blog;

class BlogRespository
{
    /**
     * 获取所有记录
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get_all(){
        return blog::all();
    }
}