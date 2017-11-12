<?php

namespace App\Repositories\Eloquent\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\admin\permissionRepository;
use App\Models\Admin\Permission;
use App\Repositories\Validators\Admin\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Eloquent\Admin;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
