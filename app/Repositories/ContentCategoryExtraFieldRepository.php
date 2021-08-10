<?php

namespace App\Repositories;

use App\Models\ContentCategoryExtraField;

class ContentCategoryExtraFieldRepository
{
    private $model;

    public function __construct(ContentCategoryExtraField $model)
    {
        $this->model = $model;
    }

    public function findAllByCategory(Int $categoryId) {
        return $this->model->where('category_id', $categoryId)->orderBy('name')->get();
    }

    public function store(Array $requestData)
    {
        return $this->model->create($requestData);
    }

    public function destroy(Int $primaryKey)
    {
        return $this->model->destroy($primaryKey);
    }
}