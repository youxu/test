<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterComposeForControCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterComposeForControCriteria implements CriteriaInterface
{
    protected $compose_id;
    public function __construct($compose_id)
    {
        $this->compose_id = $compose_id;
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $where['compose_id'] = $this->compose_id;
        $where['controller_id'] = 0;
        return $model->where($where);
    }
}
