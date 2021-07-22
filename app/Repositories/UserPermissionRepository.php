<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\SystemPermission;

class UserPermissionRepository
{
    public function __construct() { }

    public function getPermissionsByUserId(Int $userId) {
        return User::find($userId)->permissions()->get();
    }

    public function getAllPermissions() {
        return SystemPermission::all();
    }

    public function getAllPermissionsDoesntHaveUser(Int $userId) {
        return SystemPermission::with('users')->whereDoesntHave('users', function($query) use ($userId) {
            $query->where('users.id', $userId);
        })->get();
    }

    public function store(Array $permissionIds, Int $userId)
    {
        User::find($userId)->permissions()->sync($permissionIds);
    }
}