<?php

namespace App\Http\Controllers;

use App\Repositories\ContentCategoryExtraFieldRepository;
use App\Http\Requests\ContentCategoryExtraField\ContentCategoryExtraFieldGetRequest;
use App\Http\Requests\ContentCategoryExtraField\ContentCategoryExtraFieldPostRequest;

class ContentCategoryExtraFieldController extends Controller
{
    public function index(ContentCategoryExtraFieldRepository $repository, ContentCategoryExtraFieldGetRequest $request) {
        try {
            return view('content-categories.extra-fields.index', array(
                'extraFields'   => $repository->findAllByCategory($request->get('categoryId')),
                'categoryId'    => $request->get('categoryId')
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function form(ContentCategoryExtraFieldGetRequest $request) {
        return view('content-categories.extra-fields.create', [
            'categoryId' => $request->get('categoryId')
        ]);
    }

    public function store(ContentCategoryExtraFieldRepository $repository, ContentCategoryExtraFieldPostRequest $request)
    {
        try {
            $repository->store($request->all());

            return response()->json([
                'message'               => 'Ação realizada com sucesso',
                'succefulRequestAction' => 'back'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Ocorreu um erro ao salvar, tente novamente mais tarde'
            ], 500);
        }
    }

    public function destroy(ContentCategoryExtraFieldRepository $repository, Int $id)
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
}