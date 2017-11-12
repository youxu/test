<?php

namespace App\Presenters\Admin;

use App\Repositories\Transformers\Admin\CommentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CommentPresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class CommentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CommentTransformer();
    }
}
