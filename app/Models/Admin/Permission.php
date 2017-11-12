<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function contro(){
        return $this->hasOne('App\Models\Admin\Contro','permission_id','id');
    }

}
