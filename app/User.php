<?php
namespace App;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use EntrustUserTrait; // add this trait to your user model
    protected $table='user';

}