<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Service\Admin\BlogService;
use Illuminate\Http\Request;
use App\blog;

class BlogController extends Controller
{
    private $blog;
    //
    public function __construct(BlogService $blog)
    {
        $this->blog = $blog;
    }
    public function index(){
        return View('blog.list',['list' => $this->blog->get_list()]);
    }
    public function create(){
        return View('blog.create');
    }
    public function store(StoreBlogPost $request)
    {
        dd($request);
        $insert = blog::create($request);
        dd($insert);

        //
    }
}
