<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreUserRequest;
use App\Http\Requests\Admin\AdminUpdateUserRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class UsersManagementController extends Controller
{
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
            'users' => User::paginate(env('PAGINATION_SIZE'))->through(fn ($user) => [
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
            'roles' => Role::all(),
//            'permissions' => Permission::all(),
            'genders' => User::GENDERS,
            'countries' => Country::all()
        ]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param AdminStoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(AdminStoreUserRequest $request): RedirectResponse
    {
        // TODO: add choice of permissions
        $user = User::create($request->safe()->except('role'));
        $user->assignRole($request->safe()->only('role'));

        return back()->with([
            'status' => 'success',
            'message' => "Пользователь $user->login успешно создан!"
        ]);
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $permissions = $user->getAllPermissions();

        return view('admin.users.show', compact('user', 'permissions'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return Response|ResponseFactory
     */
    public function edit(User $user): Response|ResponseFactory
    {
        return inertia('Dashboard/Users/Edit', [
            'title' => 'Редактирование пользователя',
            'user' => $user,
            'genders' => User::GENDERS,
            'countries' => Country::all(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param AdminUpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(AdminUpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->safe()->except('role'));
        $user->syncRoles($request->safe()->only('role'));

        return back()->with([
            'status' => 'success',
            'message' => "Информация о пользователе $user->login была успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Пользователь $user->login был удален!"
        ]);
    }
}
