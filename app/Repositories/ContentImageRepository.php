<?php

namespace App\Repositories;

use App\Models\ContentImage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Storage;

class ContentImageRepository
{
    private $model;
    private $imageNames;

    public function __construct(ContentImage $model)
    {
        $this->model        = $model;
        $this->imageNames   = [];
    }

    public function findAllWithPaginate(Int $contentId, Int $perPage)
    {
        return $this->model->where('content_id', $contentId)->simplePaginate($perPage)->withQueryString();
    }

    public function findById(Int $id)
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    public function uploadImages($files) {
        foreach ($files as $file) {
            $fileName = $file->store(env('STORAGE_CONTENT_IMAGES_PATH'));
            array_push($this->imageNames, basename($fileName));
        }
    }

    public function store(Int $contentId)
    {
        $data = [];

        if(count($this->imageNames) < 1) {
            throw new HttpResponseException(response()->json([
                'message' => 'Nenhuma imagem para salvar no banco de dados'
            ], 500));
        }

        foreach($this->imageNames as $imageName) {
            $image = [
                'path'          => $imageName,
                'content_id'    => $contentId
            ];

            array_push($data, $image);
        }

        $this->model->insert($data);
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