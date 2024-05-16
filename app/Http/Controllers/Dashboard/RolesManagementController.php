<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\StoreRequest;
use App\Http\Requests\Dashboard\Role\UpdateRequest;
use App\Http\Requests\Dashboard\Role\DestroyRequest;
use App\Http\Requests\Dashboard\Role\DeleteSelectedRequest;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class RolesManagementController extends Controller
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
     * Display a listing of the roles.
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
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $role = Role::create($request->safe()->only('name'))
            ->syncPermissions($request->safe()->only('permissions'));

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
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Role $role): RedirectResponse
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
     */
    public function destroy(DestroyRequest $request, Role $role)
    {
        $validated = $request->validated();
        $role->delete();

        $redirectToPage = min($validated['current_page'], Role::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.roles.index', ['page' => $redirectToPage])
            ->with([
            'status' => 'success',
            'message' => "Роль $role->name была удалена!"
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

        return redirect()->route('dashboard.roles.index', ['page' => $redirectToPage])
            ->with([
            'status' => 'success',
            'message' => 'Выбранные роли были удалены.'
        ]);
    }
}
