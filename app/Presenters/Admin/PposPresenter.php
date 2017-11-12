<?php

namespace App\Presenters\Admin;

use App\Repositories\Transformers\Admin\PposTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PposPresenter
 *
 * @package namespace App\Presenters\Admin;
 */
class PposPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PposTransformer();
    }
}
