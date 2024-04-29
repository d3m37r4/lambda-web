<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RolesManagementController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        return inertia('Dashboard/Roles/Index', [
            'title' => 'Управление ролями',
            'roles' => Role::paginate(env('PAGINATION_SIZE'))->through(fn ($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'created_at' => $role->created_at->format('d.m.Y - H:i:s'),
                'updated_at' => $role->updated_at->format('d.m.Y - H:i:s'),
            ])
        ]);
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return inertia('Dashboard/Roles/Create', [
            'title' => 'Новая роль',
            'permissions' => Permission::all(),
        ]);
    }


    /**
     * Store a newly created role in storage.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->safe()->only('name'))
            ->givePermissionTo($request->safe()->only('permissions'));

        return back()->with([
            'status' => 'success',
            'message' => "Новая роль $role->name успешно создана!"
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
    public function edit(Role $role): View
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->safe()->only('name'));
        $role->syncPermissions($request->safe()->only('permissions'));

        return back()->with([
            'status' => 'success',
            'message' => "Информация о роли $role->name была успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Роль $role->name была удалена!"
        ]);
    }
}
