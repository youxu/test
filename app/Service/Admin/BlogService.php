<?php
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/8/3
 * Time: 下午5:34
 */
namespace App\Service\Admin;
use App\Repositories\Contracts\Admin\BlogRepository;
class BlogService{

    protected $blog;
    public function __construct(BlogRepository $blog)
    {
        $this->blog = $blog;
    }
    public function get_list(){
        return $this->blog->all();
    }
}