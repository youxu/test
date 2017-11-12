<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\RoleRequest;
use App\Repositories\Contracts\Admin\RoleRepository;
use App\Http\Controllers\Controller;
use App\Service\Admin\RoleService;


class RolesController extends Controller
{

    /**
     * @var RoleRepository
     */
    protected $repository;
    protected $service;

    /**
     * @var RoleValidator
     */
    protected $validator;

    public function __construct(RoleRepository $repository,RoleService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $roles = $this->repository->paginate(trans('admin/role.pageNum'));
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roles,
            ]);
        }
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {

        try {
            $role = $this->service->stroeRole($request);

            $response = [
                'message' => trans('admin/alert.role.create_success'),
                'data'    => $role->toArray(),
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            flash()->overlay(trans('admin/alert.role.create_success'), trans('admin/action.message_title'));
            return redirect('admin/role');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ]);
            }
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function create(){
        $roleList = $this->service->getRoleList();
        return view('admin.role.create',compact('roleList'));
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
        $role = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $role,
            ]);
        }

        return view('roles.show', compact('role'));
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

        $role = $this->repository->find($id);
        $roleList = $this->service->getRoleList();
        $permissionRole = $this->service->getRolePermissionByRoleId($role->id);
        return view('admin.role.edit', compact('role','roleList','permissionRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {

        try {

            $role = $this->service->updateRole($request, $id);
            $response = [
                'message' => trans('admin/alert.role.edit_success'),
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            flash()->overlay(trans('admin/alert.role.edit_success'), trans('admin/action.message_title'));
            return redirect('admin/role');
        } catch (\Exception $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ]);
            }
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
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
        $deleted = $this->service->deleteRole($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => trans('admin/alert.role.destroy_success'),
                'deleted' => $deleted,
            ]);
        }
        flash()->overlay(trans('admin/alert.role.destroy_success'), trans('admin/action.message_title'));
        return redirect('admin/role');
    }
}
