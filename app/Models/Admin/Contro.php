<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Contro extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['compose_id','controller_id','func_name','func_name_cn','is_menu','is_right','order_num','icon','permission_id','active','url'];
    protected $table='controller';
    public function compose(){
        return $this->hasOne('App\Models\Admin\compose','id','compose_id');
    }
}
