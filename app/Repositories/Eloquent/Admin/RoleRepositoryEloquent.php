<?php

namespace App\Repositories\Eloquent\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\admin\RoleRepository;
use App\Models\Admin\Role;
use App\Repositories\Validators\Admin\RoleValidator;
use App\Models\Admin\PermissionRole;
use Illuminate\Container\Container as Application;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories\Eloquent\Admin;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    protected $permissionRole;
    protected $fieldSearchable = [
        'name'=>'like',
        'display_name'=>'like'
    ];
    public function __construct(Application $app,PermissionRole $permissionRole)
    {
        parent::__construct($app);
        $this->permissionRole = $permissionRole;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getPermissionRole($role_id){
        if(empty($role_id)){
            return false;
        }
        else{
            $res = $this->permissionRole->where(['role_id' => $role_id])->get(['permission_id']);
            return $res;
        }

    }
}
