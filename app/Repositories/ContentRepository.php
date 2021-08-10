<?php

namespace App\Repositories;

use App\Models\Content;
use App\Models\ContentExtraField;
use Illuminate\Http\Request;

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
        return $this->model->create($requestData)->id;
    }

    public function destroy(Int $primaryKey)
    {
        return $this->model->destroy($primaryKey);
    }

    public function update(Array $requestData)
    {
        return $this->model->find((int)$requestData['id'])->fill($requestData)->update();
    }

    public function extractAllContentExtraFields(Request $request) {
        $params         = $request->all();
        $extraFields    = [];

        foreach($params as $paramName => $paramValue) {
            if(!empty($paramValue) && strpos($paramName, "EX__") === 0) { // If param name starts with "EX__" is a extra field //
                $fieldName = substr($paramName, 4);
                $extraFields[$fieldName] = $paramValue;

                $request->request->remove($paramName);
            }
        }

        return $extraFields;
    }

    public function storeExtraFields($extraFields, $contentId) {
        $data = [];

        foreach($extraFields as $paramName => $paramValue) {
            array_push($data, ['name' => $paramName, 'value' => $paramValue, 'content_id' => $contentId]);
        }

        ContentExtraField::insert($data);
    }
}