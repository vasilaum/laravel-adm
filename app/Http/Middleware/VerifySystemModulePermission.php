<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Helpers\StringHelper;

class VerifySystemModulePermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->master) { // Full system access user //
            $this->setPermissionsIntoSession(['MASTER']);
            return $next($request);
        }

        $userPermissions    = $this->getPermissionsByUser($user->id);
        $userHasPermission  = $this->hasPermission($userPermissions, $request);

        if (!$userHasPermission) {
            abort(403);
        }

        $this->setPermissionsIntoSession($userPermissions);

        return $next($request);
    }

    private function getPermissionsByUser(Int $userId)
    {
        return DB::select(
            "
                SELECT
                    smau.user_id,
                    sma.name as action_name,
                    sma.url_action as url_action,
                    sma.http_method as http_method,
                    sm.name as module_name,
                    sm.codename as module_codename
                FROM
                    system_modules_actions_users smau,
                    system_modules_actions sma,
                    system_modules sm
                WHERE
                    smau.user_id = ?
                    AND
                    smau.system_module_action_id = sma.id
                    AND
                    sma.system_module_id = sm.id
            ",
            [$userId]
        );
    }

    private function hasPermission(Array $userPermissions, Request $request)
    {
        $pathSegments   = explode('/', $request->route()->uri());
        $urlAction      = str_replace($request->route()->parameterNames(), 'param', $request->route()->uri());

        if(count($userPermissions) < 1) {
            return FALSE;
        }

        foreach ($userPermissions as $permission) {
            if (
                in_array($urlAction, explode(',', $permission->url_action))
                &&
                $permission->http_method === $request->method()
                &&
                $permission->module_codename === current($pathSegments)
            ) {
                return TRUE;
            }
        }

        return FALSE;
    }

    private function setPermissionsIntoSession(Array $userPermissions)
    {
        session(['userPermissions' => $userPermissions]);
    }

}