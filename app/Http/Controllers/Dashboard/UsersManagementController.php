<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Http\Requests\Dashboard\User\DestroyRequest;
use App\Http\Requests\Dashboard\User\DeleteSelectedRequest;
use Illuminate\Http\RedirectResponse;

class UsersManagementController extends Controller
{
    /**
     * The number of users to return for pagination.
     *
     * @var int
     */
    protected int $perPage = 8;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap(): array
    {
        return [
            'show' => 'view',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete'
        ];
    }

    /**
     * Display a listing of users
     */
    public function index()
    {
        return inertia('Dashboard/Users/Index', [
            'title' => 'Управление пользователями',
            'users' => User::paginate($this->perPage)->through(fn ($user) => [
                'id' => $user->id,
                'login' => $user->login,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at->format('d.m.Y - H:i:s'),
            ])
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return inertia('Dashboard/Users/Create', [
            'title' => 'Новый пользователь',
            'roles' => Role::with(['permissions' => function ($query) {
                $query->select('permissions.id', 'permissions.name');
            }])->get(['id', 'name']),
            'permissions' => Permission::orderBy('id')->get(['id', 'name']),
            'genders' => User::GENDERS,
            'countries' => Country::all()
        ]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $user = User::create($request->safe()->except('role', 'permissions'));
        $user->assignRole($request->safe()->only('role'));

        if (!empty($request->input('permissions'))) {
            $user->syncPermissions($request->safe()->only('permissions'));
        }

        return redirect()->route('dashboard.users.index', ['page' => User::paginate($this->perPage)->lastPage()])
            ->with([
            'status' => 'success',
            'message' => "Пользователь $user->login успешно создан!"
        ]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return inertia('Dashboard/Users/Edit', [
            'title' => "Редактирование пользователя $user->login",
            'user' => $user->only([
                'id',
                'login',
                'email',
                'role',
                'permissions',
                'gender',
                'name'
            ]),
            'roles' => Role::with(['permissions' => function ($query) {
                $query->select('permissions.id', 'permissions.name');
            }])->get(['id', 'name']),
            'permissions' => Permission::orderBy('id')->get(['id', 'name']),
            'genders' => User::GENDERS,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->safe()->except('role', 'permissions'));
        $user->syncRoles($request->safe()->only('role'));

        if (!empty($request->input('permissions'))) {
            $user->syncPermissions($request->safe()->only('permissions'));
        } else {
            $user->revokePermissionTo($user->permissions);
        }

        return back()->with([
            'status' => 'success',
            'message' => "Данные о \"$user->login\" обновлены."
        ]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(DestroyRequest $request, User $user)
    {
        $validated = $request->validated();
        $user->delete();

        $redirectToPage = min($validated['current_page'], User::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.users.index', ['page' => $redirectToPage])
            ->with([
            'status' => 'deleted',
            'message' => "Пользователь \"$user->login\" удален."
        ]);
    }

    /**
     * Delete selected users from storage.
     */
    public function deleteSelected(DeleteSelectedRequest $request)
    {
        $validated = $request->validated();
        User::whereIn('id', $validated['ids'])->delete();

        $redirectToPage = min($validated['current_page'], User::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.users.index', ['page' => $redirectToPage])
            ->with([
                'status' => 'deleted',
                'message' => 'Выбранные пользователи удалены.'
            ]);
    }
}
