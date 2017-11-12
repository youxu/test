<?php

namespace App\Repositories\Eloquent\Admin;

use Illuminate\Support\Facades\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\admin\ControRepository;
use App\Models\Admin\Contro;
use App\Repositories\Validators\Admin\ControValidator;

/**
 * Class ControRepositoryEloquent
 * @package namespace App\Repositories\Eloquent\Admin;
 */
class ControRepositoryEloquent extends BaseRepository implements ControRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contro::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * controller方法列表
     * @param $contro_id
     * @return mixed
     */
    public function getFunctionList($contro_id){
        return $this->findWhere(['controller_id' => $contro_id]);
    }

    public function allMenus()
    {
        $compose_id = Request::input('compose_id',1);
        return $this->model->where(['is_menu' => 1,'compose_id' => $compose_id])->orderBy('order_num','act')->get()->toArray();
    }

}
