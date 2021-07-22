<?php

namespace App\Http\Controllers;

use App\Repositories\UserPermissionRepository;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function index(UserPermissionRepository $repository, Int $userId)
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

    public function store(UserPermissionRepository $repository, Request $request, Int $userId)
    {
        try {
            $permissionIds = $request->get('permissions') ?? [];
            $repository->store($permissionIds, $userId);


            return redirect(route('users.permissions.index', ['userId' => $userId]));
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->view('errors.500', [], 500);
        }
    }
}
