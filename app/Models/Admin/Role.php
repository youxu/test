<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name','display_name','description'];
}
