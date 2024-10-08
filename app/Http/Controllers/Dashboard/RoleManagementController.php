<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\StoreRequest;
use App\Http\Requests\Dashboard\Role\UpdateRequest;
use App\Http\Requests\Dashboard\Role\DestroyRequest;
use App\Http\Requests\Dashboard\Role\DeleteSelectedRequest;

class RoleManagementController extends Controller
{
    /**
     * The number of roles to return for pagination.
     *
     * @var int
     */
    protected int $perPage = 8;

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
     * Display a listing of roles.
     */
    public function index()
    {
        return inertia('Dashboard/Roles/Index', [
            'title' => 'Управление ролями',
            'roles' => Role::paginate($this->perPage)->through(fn ($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions,
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
     */
    public function store(StoreRequest $request)
    {
        $role = Role::create($request->safe()->only('name'))
            ->syncPermissions($request->safe()->only('permissions'));

        return back()->with([
            'status' => 'success',
            'message' => "Роль \"$role->name\" создана."
        ]);
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        return inertia('Dashboard/Roles/Edit', [
            'title' => "Редактирование роли $role->name",
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->pluck(['id'])
            ],
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Update the specified role in storage.
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $role->update($request->safe()->only('name'));
        $role->syncPermissions($request->safe()->only('permissions'));

        return back()->with([
            'status' => 'success',
            'message' => "Роль \"$role->name\" обновлена."
        ]);
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(DestroyRequest $request, Role $role)
    {
        $validated = $request->validated();
        $role->delete();

        $redirectToPage = min($validated['current_page'], Role::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.roles.index', [
            'page' => $redirectToPage
        ])->with([
            'status' => 'deleted',
            'message' => "Роль \"$role->name\" удалена."
        ]);
    }

    /**
     * Delete selected roles from storage.
     */
    public function deleteSelected(DeleteSelectedRequest $request)
    {
        $validated = $request->validated();
        Role::whereIn('id', $validated['ids'])->delete();

        $redirectToPage = min($validated['current_page'], Role::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.roles.index', [
            'page' => $redirectToPage
        ])->with([
            'status' => 'deleted',
            'message' => 'Выбранные роли удалены.'
        ]);
    }
}
