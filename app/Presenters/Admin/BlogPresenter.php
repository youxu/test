<?php

namespace App\Presenters\Admin;

use App\Repositories\Transformers\Admin\BlogTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BlogPresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class BlogPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlogTransformer();
    }
}
