<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{
    //
    public function index(Route $request){
        dump(app());

        //添加角色
//        $owner = new Role();
//        $owner->name         = 'owner';
//        $owner->display_name = 'Project Owner'; // optional
//        $owner->description  = 'User is the owner of a given project'; // optional
//        $owner->save();
//        $admin = new Role();
//        $admin->name         = 'admin';
//        $admin->display_name = 'User Administrator'; // optional
//        $admin->description  = 'User is allowed to manage and edit other users'; // optional
//        $admin->save();
//        //添加用户权限
//        $user = User::where('name', '=', '管理员')->first();
//        $role_admin = Role::where('name','=','admin')->first();
//// role attach alias
//        $user->attachRole($role_admin); // parameter can be an Role object, array, or id

// or eloquent's original technique
//        $user->roles()->attach($admin->id); // id only
        //角色添加权限
//        $createPost = new Permission();
//        $createPost->name         = 'create-post';
//        $createPost->display_name = 'Create Posts'; // optional
//// Allow a user to...
//        $createPost->description  = 'create new blog posts'; // optional
//        $createPost->save();
//
//        $editUser = new Permission();
//        $editUser->name         = 'edit-user';
//        $editUser->display_name = 'Edit Users'; // optional
//// Allow a user to...
//        $editUser->description  = 'edit existing users'; // optional
//        $editUser->save();
//        $admin = Role::where('name','=','admin')->first();
//        $owner = Role::where('name','=','owner')->first();
//        $admin->attachPermission($createPost);
//        $owner->attachPermissions(array($createPost, $editUser));
//        dump( $request->uri());

    }
}
