<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    protected $fillable = ['pid','name','icon','slug','url','active','description','sort','status'];
    protected $dates = ['delete_at'];
    public function setSortAttribute($value)
    {
        if ($value && is_numeric($value)) {
            $this->attributes['sort'] = intval($value);
        }else{
            $this->attributes['sort'] = 0;
        }
    }
}
