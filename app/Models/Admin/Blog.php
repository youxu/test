<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Blog extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];
    public function comments(){
        return $this->hasMany(comment::class);
    }
    public function getCountCommentAttribute(){
        return $this->comments()->count();
    }
}
