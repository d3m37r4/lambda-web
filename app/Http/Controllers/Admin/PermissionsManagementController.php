<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PermissionsManagementController extends Controller {
    /**
     * Get the permissions of the specified role
     *
     * @param $id
     * @return array|void
     * @noinspection PhpVoidFunctionResultUsedInspection
     */
    public function getRolePermissions($id): array {
        if(!is_int($id) && !is_null($id)) {
            return abort(422);
        }

        return DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id')
            ->all();
    }
}
