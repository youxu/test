<?php

namespace App\Repositories\Eloquent\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\Admin\PposRepository;
use App\Models\Admin\Ppos;
use App\Repositories\Validators\Admin\PposValidator;

/**
 * Class PposRepositoryEloquent
 * @package namespace App\Repositories\Eloquent\Admin;
 */
class PposRepositoryEloquent extends BaseRepository implements PposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ppos::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
