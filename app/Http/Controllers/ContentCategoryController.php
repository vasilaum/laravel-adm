<?php

namespace App\Http\Controllers;

use App\Repositories\ContentCategoryRepository;
use App\Http\Requests\ContentCategory\ContentCategoryPostRequest;
use App\Http\Requests\ContentCategory\ContentCategoryPutRequest;

class ContentCategoryController extends Controller
{
    public function index(ContentCategoryRepository $repository)
    {
        try {
            return view('content-categories.index', array(
                'categories' => $repository->findAllWithPaginate(10)
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function form(ContentCategoryRepository $repository, Int $id = NULL)
    {
        try {
            if (!empty($id)) {
                return view('content-categories.edit', array(
                    'category' => $repository->findById($id)
                ));
            }

            return view('content-categories.create');
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(ContentCategoryPostRequest $request, ContentCategoryRepository $repository)
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

    public function update(ContentCategoryPutRequest $request, ContentCategoryRepository $repository)
    {
        try {
            $repository->update($request->all());

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

    public function destroy(ContentCategoryRepository $repository, Int $id)
    {
        try {
            $result = $repository->destroy($id);
        } catch (\Illuminate\Database\QueryException $ex1) {
            if($ex1->getCode() == 23000) {
                return response()->json(array(
                    'errors'    => (object)[],
                    'message'   => "Esta categoria contem conteúdos vinculados, para sua segurança delete todos os conteúdos antes, ou somente desative esta categoria"
                ), 400);
            }

            return response()->json(array(
                'errors'    => (object)[],
                'message'   => "Error: " . $ex1->getMessage()
            ), 400);
        } catch (\Exception $ex2) {
            return response()->json(array(
                'errors'    => (object)[],
                'message'   => "Error: " . $ex2->getMessage()
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