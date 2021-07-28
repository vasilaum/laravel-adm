<?php

namespace App\Http\Controllers;

use App\Repositories\SystemModuleRepository;
use App\Http\Requests\SystemModule\SystemModulePostRequest;
use App\Http\Requests\SystemModule\SystemModulePutRequest;

class SystemModuleController extends Controller
{
    public function index(SystemModuleRepository $repository)
    {
        try {
            return view('system-modules.index', array(
                'systemModules' => $repository->findAllWithPaginate(1)
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function form(SystemModuleRepository $repository, Int $id = NULL)
    {
        try {
            if (!empty($id)) {
                return view('system-modules.edit', array(
                    'systemModule' => $repository->findById($id)
                ));
            }

            return view('system-modules.create');
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(SystemModulePostRequest $request, SystemModuleRepository $repository)
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

    public function update(SystemModuleRepository $repository, SystemModulePutRequest $request)
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

    public function destroy(SystemModuleRepository $repository, Int $id)
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