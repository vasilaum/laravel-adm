<?php

namespace App\Http\Controllers;

use App\Repositories\SystemPermissionRepository;
use App\Http\Requests\SystemPermission\SystemPermissionPostRequest;
use App\Http\Requests\SystemPermission\SystemPermissionPutRequest;

class SystemPermissionController extends Controller
{
    public function index(SystemPermissionRepository $repository, Int $moduleId)
    {
        try {
            return view('system-permissions.index', array(
                'systemModulesActions'  => $repository->findAllWithPaginate(1, $moduleId),
                'systemModuleId'        => $moduleId
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function form(SystemPermissionRepository $repository, Int $moduleId, Int $id = NULL)
    {
        try {
            if (!empty($id)) {
                return view('system-permissions.edit', array(
                    'systemPermission'      => $repository->findById($id),
                    'systemModuleId'        => $moduleId
                ));
            }

            return view('system-permissions.create', array(
                'systemModuleId'        => $moduleId
            ));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(SystemPermissionRepository $repository, SystemPermissionPostRequest $request)
    {
        try {
            $repository->store($request->all());

            return redirect(route('system.permissions.index', ['moduleId' => $request->get('system_module_id')]));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function update(SystemPermissionRepository $repository, SystemPermissionPutRequest $request)
    {
        try {
            $repository->update($request->all());

            return redirect(route('system.permissions.index', ['moduleId' => $request->get('system_module_id')]));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function destroy(SystemPermissionRepository $repository, Int $id)
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