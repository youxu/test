<?php

namespace App\Repositories\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Models\Admin\Blog;

/**
 * Class BlogTransformer
 * @package namespace App\Repositories\Transformers\Admin;
 */
class BlogTransformer extends TransformerAbstract
{

    /**
     * Transform the \Blog entity
     * @param \Blog $model
     *
     * @return array
     */
    public function transform(Blog $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
