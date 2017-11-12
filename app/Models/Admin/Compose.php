<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Compose extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['cn_name','en_name','order_num','status','is_show'];

    /**
     * 更新/创建时间为int类型
     * @param \DateTime|int $value
     * @return false|int
     */
    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }

    public function getStatusAttribute($value){
        $status = [1=>'可用',0=>'不可用'];
        return $status[$value];
    }

    public function getIsShowAttribute($value){
        $status = [1=>'显示',0=>'不显示'];
        return $status[$value];
    }
}
