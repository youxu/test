<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\ControRequest;
use App\Repositories\Contracts\Admin\ControRepository;
use App\Service\Admin\ControService;
use App\Http\Controllers\Controller;
use App\Service\Admin\ComposeService;
use App\Http\Requests\admin\MethodRequest;
use App\Http\Requests\admin\MethodCreateRequest;
class ControsController extends Controller
{

    /**
     * @var ControRepository
     */
    protected $service;
    protected $copmpose;

    /**
     * @var ControValidator
     */

    public function __construct(ControService $service,ComposeService $copmpose)
    {
        $this->service = $service;
        $this->copmpose = $copmpose;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($compose_id)
    {
        $ControllerList = $this->service->getControllerList($compose_id);
        return view('admin.contro.index', compact('ControllerList','compose_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ControCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ControRequest $request)
    {
        $res = $this->service->storeContro($request);
        return redirect('admin/contro/index/'.$request->compose_id);
    }

    /**
     * 新建控制器
     * @param $compose_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($compose_id){
        $composeList = $this->copmpose->getList();
        return view('admin.contro.create',compact('composeList','compose_id'));
    }

    /**
     * 方法列表
     * @param $contro_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_method($contro_id){
        $contro = $this->service->contro->find($contro_id);
        $method_list = $this->service->getMethodList($contro_id);
        return view('admin.contro.list_method',compact('method_list','contro_id','contro'));
    }

    /**
     * 编辑方法
     * @param MethodRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_method(MethodRequest $request){
        $res = $this->service->updateMethod($request->update);
        return redirect('admin/contro/list_method/'.$request->input('contro_id'));
    }

    /**
     * 新建方法（动作）
     * @param MethodCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_method(MethodCreateRequest $request){
        $contro_id = $request->contro_id;
        $this->service->storeMethod($request);
        return redirect('admin/contro/list_method/'.$contro_id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($compose_id)
    {
        $composeList = $this->copmpose->getList();
        $contro = $this->service->contro->find($compose_id);
        return view('admin.contro.edit', compact('contro','composeList','compose_id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ControUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ControRequest $request, $id)
    {
        $this->service->editContro($request,$id);
        return redirect('admin/contro/index/'.$request->compose_id);
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
        $this->service->delContro($id);
        return redirect()->back();
    }
}
