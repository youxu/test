<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $appends = ['count_comment'];
    public function comments(){
        return $this->hasMany(comment::class);
    }
    public function getCountCommentAttribute(){
        return $this->comments()->count();
    }
}
