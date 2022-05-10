<?php

namespace App\Http\Controllers\Admin;

use Request;
use Session;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreUserRequest;
use App\Http\Requests\Admin\AdminUpdateUserRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UsersManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::paginate(env('PAGINATION_SIZE'));
        $roles = Role::all();

        Session::put('redirect_url', Request::fullUrl());

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
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

        return redirect(session('redirect_url'))->with([
            'status' => 'success',
            'message' => "Пользователь {$user->login} успешно создан!"
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
     * @return View
     */
    public function edit(User $user): View
    {
        $genders = User::GENDERS;
        $countries = Country::all();
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'genders', 'countries',   'roles'));
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
            'message' => "Информация о пользователе {$user->login} была успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Пользователь {$user->login} был удален!"
        ]);
    }
}
