<?php

namespace App\Repositories;

use App\Models\User as User;

class UserRepository
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findAllWithPaginate(Int $perPage)
    {
        return $this->model->simplePaginate($perPage);
    }

    public function findById(Int $id)
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    public function store(Array $requestData)
    {
        return $this->model->create($requestData);
    }

    public function destroy(Int $primaryKey)
    {
        return $this->model->destroy($primaryKey);
    }

    public function update(Array $requestData)
    {
        $id             = (int) $requestData['user_id'];
        $user           = $this->model->find($id);

        $user->name     = $requestData['name'];
        $user->email    = $requestData['email'];

        if(!empty($requestData['password'])) {
            $user->password = $requestData['password'];
        }

        $user->save();
    }
}