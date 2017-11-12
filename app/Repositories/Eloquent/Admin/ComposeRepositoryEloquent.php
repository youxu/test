<?php

namespace App\Repositories\Eloquent\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\admin\composeRepository;
use App\Models\Admin\Compose;
use App\Repositories\Validators\Admin\ComposeValidator;

/**
 * Class ComposeRepositoryEloquent
 * @package namespace App\Repositories\Eloquent\Admin;
 */
class ComposeRepositoryEloquent extends BaseRepository implements ComposeRepository
{
    protected $fieldSearchable = [
        'cn_name'=>'like',
        'en_name'=>'like',
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Compose::class;
    }


    public function allCompose($where = ['status' => 1]){
        $this->model->orderBy('order_num')->where($where)->get();
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
