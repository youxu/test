<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Transformable,Authenticatable
{
    use TransformableTrait;
    use EntrustUserTrait;
    use AuthenticableTrait;

    protected $fillable = ['name','email','password'];
    protected $table='user';
    public function role(){
        return $this->hasMany('App\Models\Admin\UserRole');
    }
}
