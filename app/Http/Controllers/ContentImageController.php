<?php

namespace App\Http\Controllers;

use App\Repositories\ContentImageRepository;
use App\Http\Requests\ContentImage\ContentImageGetRequest;
use App\Http\Requests\ContentImage\ContentImagePostRequest;
use App\Http\Requests\ContentImage\ContentImagePutRequest;

class ContentImageController extends Controller
{
    public function index(ContentImageGetRequest $request, ContentImageRepository $repository)
    {
        try {
            return view('contents.images.index', array(
                'images'        => $repository->findAllWithPaginate($request->get('contentId'), 30),
                'contentId'     => $request->get('contentId')
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(ContentImagePostRequest $request, ContentImageRepository $repository)
    {
        try {
            if($request->hasFile('files')) {
                $repository->uploadImages($request->file('files'));
            }

            $repository->store($request->get('content_id'));

            return response()->json([
                'message'               => 'Ação realizada com sucesso',
                'succefulRequestAction' => 'reload'
            ], 200);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'message'   => 'Ocorreu um erro ao salvar, tente novamente mais tarde'
            ], 500);
        }
    }

    public function destroy(ContentImageRepository $repository, Int $id)
    {
        try {
            $result = $repository->destroy($id);
        } catch (\Exception $e) {
            return response()->json(array(
                'errors'    => (object)[],
                'message'   => "Error: " . $e->getMessage()
            ), 400);
        }

        if (!$result) {
            return response()->json(array(
                'errors'    => (object)[],
                'message'   => "Ocorreu um erro ao deletar o registro no banco de dados"
            ), 400);
        }

        return response()->json(array(
            'errors'    => (object)[],
            'message'   => "Registro deletado com sucesso!"
        ), 200);
    }

    public function update(ContentImagePutRequest $request, ContentImageRepository $repository)
    {
        try {
            $repository->update($request->all());

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