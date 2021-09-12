<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class RolesManagementController extends Controller {
    /**
     * Display a listing of the roles.
     *
     * @return View
     */
    public function index(): View {
        $roles = Role::paginate(env('PAGINATION_SIZE'));

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return View
     */
    public function create(): View {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse {
        $role = Role::create($request->safe()->only('name'))
            ->givePermissionTo($request->safe()->only('permissions'));

        return redirect() ->route('admin.roles.index')->with([
            'status' => 'success',
            'message' => "Новая роль {$role->name} успешно создана!"
        ]);
    }

    /**
     * Display the specified role.
     *
     * @param Role $role
     * @return Response
     */
//    public function show(Role $role): Response {
//        //
//    }

    /**
     * Show the form for editing the specified role.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View {
        $permissions = Permission::all();
        $redirect = $this->getPreviousUrl(action([ServersManagementController::class, 'index']));

        return view('admin.roles.edit', compact('role', 'permissions','redirect'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse {
        $role->update($request->safe()->only('name'));
        $role->syncPermissions($request->safe()->only('permissions'));

        return back()->with([
            'status' => 'success',
            'message' => "Информация о роли {$role->name} была успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse {
        $role->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Роль {$role->name} была удалена!"
        ]);
    }

    /**
     * Gets previous url or, if previous url is equal to current one, sets desired standard value
     *
     * @param string $defaultUrl
     * @return string
     */
    function getPreviousUrl(string $defaultUrl): string {
        $previous = URL::previous();
        return (($previous !== URL::current()) ? $previous : $defaultUrl);
    }
}
