<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\User\UserPostRequest;
use App\Http\Requests\User\UserPutRequest;

class UserController extends Controller
{
    public function index(UserRepository $repository)
    {
        try {
            return view('users.index', array(
                'users' => $repository->findAllWithPaginate(1)
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function form(UserRepository $repository, Int $id = NULL)
    {
        try {
            if (!empty($id)) {
                return view('users.edit', array(
                    'user' => $repository->findById($id)
                ));
            }

            return view('users.create');
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(UserPostRequest $request, UserRepository $repository)
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

    public function update(UserRepository $repository, UserPutRequest $request)
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

    public function destroy(UserRepository $repository, Int $id)
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