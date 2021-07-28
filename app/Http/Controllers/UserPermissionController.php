<?php

namespace App\Http\Controllers;

use App\Repositories\UserPermissionRepository;
use App\Http\Requests\UserPermission\UserPermissionGetRequest;

class UserPermissionController extends Controller
{
    // $request required for validation for $userId param //
    public function index(UserPermissionGetRequest $request, UserPermissionRepository $repository, Int $userId)
    {
        try {
            return view('users.permissions.index', array(
                'userPermissions'   => $repository->getPermissionsByUserId($userId),
                'othersPermissions' => $repository->getAllPermissionsDoesntHaveUser($userId),
                'userId'            => $userId
            ));
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(UserPermissionGetRequest $request, UserPermissionRepository $repository, Int $userId)
    {
        try {
            $permissionIds = $request->get('permissions') ?? [];
            $repository->store($permissionIds, $userId);


            return response()->json([
                'message'               => 'Ação realizada com sucesso',
                'succefulRequestAction' => 'reload'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Ocorreu um erro ao salvar, tente novamente mais tarde'
            ], 500);
        }
    }
}
