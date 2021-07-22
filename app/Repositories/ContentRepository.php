<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository
{
    private $model;

    public function __construct(Content $model)
    {
        $this->model = $model;
    }

    public function findAllWithPaginate(Int $categoryId, Int $perPage)
    {
        return $this->model->where('category_id', $categoryId)->simplePaginate($perPage)->withQueryString();
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
        return $this->model->find((int)$requestData['id'])->fill($requestData)->update();
    }
}