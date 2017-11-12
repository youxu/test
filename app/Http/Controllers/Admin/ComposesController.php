<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Service\Admin\ComposeService;
use App\Http\Requests\admin\ComposeRequest;
use App\Http\Controllers\Controller as Controller;


class ComposesController extends Controller
{

    protected $service;


    public function __construct(ComposeService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = $this->service->getList();
        return view('admin.compose.index',compact('list'));
    }
    /**
     * 添加组件
     * @return $this
     */
    public function create(){

        return view('admin.compose.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ComposeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(composeRequest $request)
    {

        $this->service->stroeCompose($request);
        return redirect('admin/compose');
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
        $compose = $this->service->compose->find($id);
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $compose,
            ]);
        }

        return view('composes.show', compact('compose'));
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
        $compose = $this->service->compose->find($id);
        return view('admin.compose.edit', compact('compose'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ComposeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ComposeRequest $request, $id)
    {
        $this->service->updateCompose($request,$id);
        return redirect('admin/compose');
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
        $this->service->destroyCompose($id);
        return redirect('admin/compose');
    }
}
