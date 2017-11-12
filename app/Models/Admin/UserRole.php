<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserRole extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];
    protected $table='role_user';
    public function role(){
        return $this->belongsTo('App\Models\Admin\Role');
    }
}
