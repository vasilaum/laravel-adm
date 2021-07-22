<?php

namespace App\Http\Controllers;

use App\Repositories\ContentRepository;
use App\Http\Requests\Content\ContentGetRequest;
use App\Http\Requests\Content\ContentPostRequest;
use App\Http\Requests\Content\ContentPutRequest;

class ContentController extends Controller
{
    public function index(ContentGetRequest $request, ContentRepository $repository)
    {
        try {
            return view('contents.index', array(
                'contents' => $repository->findAllWithPaginate($request->get('categoryId'), 1)
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function form(ContentRepository $repository, Int $id = NULL)
    {
        try {
            if (!empty($id)) {
                return view('contents.edit', array(
                    'content' => $repository->findById($id)
                ));
            }

            return view('contents.create');
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(ContentPostRequest $request, ContentRepository $repository)
    {
        try {
            $repository->store($request->all());

            return redirect(route('contents.index', ['categoryId' => 1]));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function update(ContentPutRequest $request, ContentRepository $repository)
    {
        try {
            $repository->update($request->all());

            return redirect()->intended('/content-categories');
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function destroy(ContentRepository $repository, Int $id)
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