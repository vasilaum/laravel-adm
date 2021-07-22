<?php

namespace App\Repositories;

use App\Models\ContentCategory;

class ContentCategoryRepository
{
    private $model;

    public function __construct(ContentCategory $model)
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
        return $this->model->find((int)$requestData['id'])->fill($requestData)->update();
    }
}