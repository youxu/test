<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Service\Admin\UserService;
use App\Http\Controllers\Controller;
use App\Events\OrderShipped;


class UsersController extends Controller
{

    /**
     * @var UserService
     */
    protected $UserService;


    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->UserService->getUserAll();
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $users,
            ]);
        }

        return view('admin.user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->UserService->storeUser($request);
        if(!$user['error']){
            return  redirect('admin/user');
        }
        else{
            return redirect()->back()->withErrors($user['message'])->withInput();
        }

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
        abort(404);
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
        $user = $this->UserService->getUserInfo($id);
        $roleList = $this->UserService->getRoleList();
//        event(new OrderShipped($user));
        return view('admin.user.edit', compact('user','roleList'));
    }

    /**
     * 新建用户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $roleLIst = $this->UserService->getRoleList();

        return view('admin.user.create',compact('roleLIst'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->UserService->updateUser($request,$id);

        if(!$user['error']){
            return redirect('admin/user');
        }
        else{
            return redirect()->back()->withErrors($user['message'])->withInput();
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
        $user = $this->UserService->deleteUser($id);
        if(!$user['error']){
            return redirect('admin/user');
        }
        else{
            return redirect()->back()->withErrors($user['message'])->withInput();
        }
    }
}
