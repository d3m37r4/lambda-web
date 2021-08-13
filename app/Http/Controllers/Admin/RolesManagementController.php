<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Permission;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class RolesManagementController extends Controller {
    /**
     * Display a listing of the roles.
     *
     * @return Application|Factory|View|Response
     */
    public function index() {
        $roles = Role::paginate(env('PAGINATION_SIZE'));

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Application|Factory|View|Response
     */
    public function create() {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $rules['name'] = ['required', 'string', 'max:255', 'unique:roles'];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $roleName = strip_tags($request->input('name'));

        $role = Role::create(['name' => $roleName]);
        $role->givePermissionTo($request->input('permissions'));
        $role->save();

        return redirect()
            ->route('admin.roles.index')
            ->with('status', 'success')
            ->with('message', "Новая роль {$roleName} успешно создана!");
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
     * @return Application|Factory|View|Response
     */
    public function edit(Role $role) {
        $permissions = Permission::all();
        $redirect = $this->getPreviousUrl(action([ServersManagementController::class, 'index']));

        return view('admin.roles.edit', compact('role', 'permissions','redirect'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse {
        $nameCheck = !empty($request->input('name')) && ($request->input('name') != $role->name);

        if ($nameCheck) {
            $rules['name'] = ['required', 'string', 'max:255', 'unique:roles'];
        }

        if (isset($rules)) {
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }

        $role->update($request->except('permission'));
        $role->syncPermissions($request->input('permissions'));

        return back()
            ->with('status', 'success')
            ->with('message', "Информация о роли {$role->name} была успешно обновлена!");
    }

    /**
     * Remove the specified role from storage.
     *
     * @param Role $role
     * @return Application|RedirectResponse|Response|Redirector|void
     * @throws Exception
     */
    public function destroy(Role $role) {
        $role->delete();

        return back()
            ->with('status', 'success')
            ->with('message', "Роль {$role->name} была удалена!");
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
