<?php
/**
 * Created by PhpStorm.
 * User: youxu
 * Date: 2017/9/12
 * Time: 下午3:03
 */
namespace App\Service\Admin;
use App\Repositories\Contracts\Admin\RoleRepository;
Use App\Repositories\Contracts\Admin\UserRepository;
use App\Repositories\Contracts\Admin\UserRoleRepository;

class UserService {

    protected $roleRepository;
    protected $userRepository;
    protected $userRoleRepository;
    public function __construct(RoleRepository $roleRepository,UserRepository $userRepository,UserRoleRepository $userRoleRepository){
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * 角色列表
     */
    public function getRoleList(){
        return $this->roleRepository->orderby('id','act')->all();
    }

    /**
     * 获取所有用户
     * @return mixed
     */
    public function getUserAll(){
        return $this->userRepository->paginate();
    }

    public function getUserInfo($id){
        return $this->userRepository->find($id);
    }
    /**
     * 创建用户
     * @param $request
     * @return bool|\illuminate\http\jsonresponse
     */
    public function storeUser($request){
        try {
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->attachroles($request->role);
            $response = [
                'message' => 'user created.',
                'data'    => $user->toarray(),
            ];

            if ($request->wantsjson()) {

                return response()->json($response);
            }
            flash()->overlay(trans('admin/alert.user.create_success'), trans('admin/action.message_title'));
            return ['error' => false];
        } catch (\exception $e) {
            $error = [
                'error'   => true,
                'message' => $e->getmessage()
            ];
            if ($request->wantsjson()) {
                return response()->json($error);
            }
            flash()->overlay(trans('admin/alert.user.create_error'), trans('admin/action.message_title'));
            return $error;
        }
    }

    /**
     * 编辑用户
     * @param $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function updateUser($request,$id){
        try {
            $user = $this->userRepository->update([
                'name' => $request->name,
                'email' => $request->email,
            ], $id);
            //删除权限
            $this->userRoleRepository->deleteWhere(['user_id' => $id]);
            //重新添加权限
            $user->attachRoles($request->role);
            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];
            if ($request->wantsJson()) {

                return response()->json($response);
            }
            flash()->overlay(trans('admin/alert.user.edit_success'), trans('admin/action.message_title'));
            return ['error' => false];
        } catch (\exception $e) {
            $error = [
                'error'   => true,
                'message' => $e->getmessage()
            ];
            if ($request->wantsjson()) {
                return response()->json($error);
            }
            flash()->overlay(trans('admin/alert.user.edit_error'), trans('admin/action.message_title'));
            return $error;
        }
    }

    /**
     * 删除用户
     * @param $id
     * @return array
     */
    public function deleteUser($id){
        $deleteUser = $this->userRepository->delete($id);

        if($deleteUser){
            flash()->overlay(trans('admin/alert.user.destroy_success'), trans('admin/action.message_title'));
            return ['error' => false];
        }
        else{
            $error = [
                'error'   => true,
                'message' => trans('admin/alert.user.destroy_error')
            ];

            return $error;
        }

    }
}