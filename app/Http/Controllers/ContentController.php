<?php

namespace App\Http\Controllers;

use App\Repositories\ContentRepository;
use App\Repositories\ContentCategoryExtraFieldRepository;
use App\Http\Requests\Content\ContentGetRequest;
use App\Http\Requests\Content\ContentPostRequest;
use App\Http\Requests\Content\ContentPutRequest;

class ContentController extends Controller
{
    private $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(ContentGetRequest $request)
    {
        try {
            return view('contents.index', array(
                'contents'      => $this->repository->findAllWithPaginate($request->get('categoryId'), 10),
                'categoryId'    => $request->get('categoryId')
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function form(ContentGetRequest $request, ContentCategoryExtraFieldRepository $contentCategoryExtraFieldRepository, Int $id = NULL)
    {
        try {
            if (!empty($id)) {
                $content                = $this->repository->findById($id);
                $categoryExtraFields    = $contentCategoryExtraFieldRepository->findAllByCategory($content->category_id);
                $mergeExtraFields       = $this->repository->extraFieldsMerge($content->extraFields, $categoryExtraFields);

                return view('contents.edit', array(
                    'content'       => $content,
                    'extraFields'   => $mergeExtraFields
                ));
            }

            return view('contents.create', array(
                'categoryId'    => $request->get('categoryId'),
                'extraFields'   => $contentCategoryExtraFieldRepository->findAllByCategory($request->get('categoryId'))
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(ContentPostRequest $request)
    {
        try {
            $contentExtraFields = $this->repository->extractAllContentExtraFields($request);
            $contentId          = $this->repository->store($request->all()); // Request is without extra fields //

            $this->repository->storeExtraFields($contentExtraFields, $contentId);

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

    public function update(ContentPutRequest $request)
    {
        try {
            $contentExtraFields = $this->repository->extractAllContentExtraFields($request);

            $this->repository->update($request->all());
            $this->repository->updateOrCreateExtraFields($contentExtraFields, $request->get('id'));

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

    public function destroy(Int $id)
    {
        try {
            $result = $this->repository->destroy($id);
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