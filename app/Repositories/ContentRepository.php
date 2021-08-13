<?php

namespace App\Repositories;

use App\Models\Content;
use App\Models\ContentExtraField;
use Illuminate\Http\Request;
use stdClass;

class ContentRepository
{
    private $model;

    public function __construct(Content $model)
    {
        $this->model = $model;
    }

    public function findAllWithPaginate(Int $categoryId, Int $perPage)
    {
        return $this->model->where('category_id', $categoryId)->orderBy('date', 'ASC')->simplePaginate($perPage)->withQueryString();
    }

    public function findById(Int $id)
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    public function store(array $requestData)
    {
        return $this->model->create($requestData)->id;
    }

    public function destroy(Int $primaryKey)
    {
        return $this->model->destroy($primaryKey);
    }

    public function update(array $requestData)
    {
        return $this->model->find((int)$requestData['id'])->fill($requestData)->update();
    }

    public function extractAllContentExtraFields(Request $request)
    {
        $params         = $request->all();
        $extraFields    = [];

        foreach ($params as $paramName => $paramValue) {
            if (!empty($paramValue) && strpos($paramName, "EX__") === 0) { // If param name starts with "EX__" is a extra field //
                $fieldName                  = substr($paramName, 4);
                $extraFields[$fieldName]    = is_array($paramValue) ? json_encode($paramValue) : $paramValue;

                $request->request->remove($paramName);
            }
        }

        return $extraFields;
    }

    public function storeExtraFields($extraFields, $contentId)
    {
        $data = [];

        foreach ($extraFields as $paramName => $paramValue) {
            array_push($data, ['name' => $paramName, 'value' => $paramValue, 'content_id' => $contentId]);
        }

        ContentExtraField::insert($data);
    }

    public function updateOrCreateExtraFields($extraFields, $contentId)
    {
        foreach ($extraFields as $paramName => $paramValue) {
            $contentExtraField = ContentExtraField::where('name', $paramName)->where('content_id', $contentId)->first();

            if (!$contentExtraField) {
                ContentExtraField::insert([
                    'name' => $paramName, 'value' => $paramValue, 'content_id' => $contentId
                ]);
            } else {
                $contentExtraField->update([
                    'name' => $paramName, 'value' => $paramValue, 'content_id' => $contentId
                ]);
            }
        }
    }

    public function extraFieldsMerge($contentExtraFields, $categoryExtraFields)
    {
        $extraFields        = [];
        $fieldsWithValue    = [];

        // Merge the content extra fields with category extra fields, place de value in fields //
        foreach ($categoryExtraFields as $categoryExtraField) {
            foreach ($contentExtraFields as $contentExtraField) {
                if ($contentExtraField->name === $categoryExtraField->name) {
                    $fieldObj               = new stdClass;
                    $fieldObj->name         = $categoryExtraField->name;
                    $fieldObj->field_id     = $categoryExtraField->field_id;
                    $fieldObj->placeholder  = $categoryExtraField->placeholder;
                    $fieldObj->label        = $categoryExtraField->label;
                    $fieldObj->mask         = $categoryExtraField->mask;
                    $fieldObj->options      = $categoryExtraField->options;
                    $fieldObj->type         = $categoryExtraField->type;
                    $fieldObj->value        = $contentExtraField->value;

                    array_push($extraFields, $fieldObj);
                    array_push($fieldsWithValue, $categoryExtraField->name);
                }
            }
        }

        // push rest of fields with no value //
        foreach ($categoryExtraFields as $categoryExtraField) {
            if (!in_array($categoryExtraField->name, $fieldsWithValue)) {
                $fieldObj               = new stdClass;
                $fieldObj->name         = $categoryExtraField->name;
                $fieldObj->field_id     = $categoryExtraField->field_id;
                $fieldObj->placeholder  = $categoryExtraField->placeholder;
                $fieldObj->label        = $categoryExtraField->label;
                $fieldObj->mask         = $categoryExtraField->mask;
                $fieldObj->options      = $categoryExtraField->options;
                $fieldObj->type         = $categoryExtraField->type;
                $fieldObj->value        = "";

                array_push($extraFields, $fieldObj);
            }
        }

        return $extraFields;
    }
}
