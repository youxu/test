<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterStatusComposeCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterStatusComposeCriteria implements CriteriaInterface
{
    protected $status;
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('status',$this->status);
    }
}
