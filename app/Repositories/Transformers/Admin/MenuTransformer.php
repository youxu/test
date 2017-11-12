<?php

namespace App\Repositories\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Models\Admin\Menu;

/**
 * Class MenuTransformer
 * @package namespace App\Repositories\Transformers\Admin;
 */
class MenuTransformer extends TransformerAbstract
{

    /**
     * Transform the \Menu entity
     * @param \Menu $model
     *
     * @return array
     */
    public function transform(Menu $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
