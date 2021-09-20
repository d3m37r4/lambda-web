<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Request;
use Session;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        // TODO: add choice of permissions
        $user = User::create($request->safe()->except('role'));
        $user->assignRole($request->safe()->only('role'));

        return redirect($request->input('redirect'))->with([
            'status' => 'success',
            'message' => "Пользователь {$user->name} успешно создан!"
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
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->safe()->except('role'));
        $user->syncRoles($request->safe()->only('role'));

        return back()->with([
            'status' => 'success',
            'message' => "Информация о пользователе {$user->name} была успешно обновлена!"
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
        $currentUser = Auth::user();
        abort_if(is_null($currentUser), 500);

        if ($currentUser->id !== $user->id) {
            $user->delete();
            return back()->with([
                'status' => 'success',
                'message' => "Пользователь {$user->name} был удален!"
            ]);
        }

        return back()->with([
            'status' => 'danger',
            'message' => "Вы не можете удалить свой профиль!"
        ]);
    }
}
