<?php

namespace App\Http\Controllers\Admin;

use App\Service\Admin\MenuService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Admin\MenuRequest;
use App\Repositories\Contracts\Admin\MenuRepository;
use App\Http\Controllers\Controller;


class MenuController extends Controller
{

    /**
     * @var MenuRepository
     */
    protected $menu;


    public function __construct(MenuService $menu)
    {
        $this->menu = $menu;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu->getMenuList();
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * 添加菜单视图
     * @return $this
     */
    public function create(){
        $menus = $this->menu->getMenuList();
        return view('admin.menu.create')->with(compact('menus'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  MenuCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $responseData = $this->menu->storeMenu($request);
        return $responseData;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = $this->menu->findMenuById($id);
        $menus = $this->menu->getMenuList();
        return view('admin.menu.show',compact('menu','menus'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $menu = $this->menu->findMenuById($id);
        $menus = $this->menu->getMenuList();
        return view('admin.menu.edit', compact('menu','menus'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  MenuUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(MenuRequest $request, $id)
    {

        $responseData = $this->menu->updateMenu($request,$id);
        return $responseData;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->menu->destoryMenu($id);
        return redirect('admin/menu');
    }
    public function orderable()
    {
        $responseData = $this->menu->orderable(request('nestable',''));
        return response()->json($responseData);
    }
}
