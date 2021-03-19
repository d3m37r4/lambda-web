<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersManagementController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of users
     *
     * @return Application|Factory|View
     */
    public function showUsers() {
        $users = User::all();
        $roles = Role::all();
//        $roles = \Auth::user()->getRoleNames();

        return view('admin.users.show-users', compact('users', 'roles'));
    }

    /**
     * Display form for creating a new user.
     */
    public function createNewUser(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            dd($data);
//            $validator = Validator::make($data, [
//                'name' => 'required|string|unique:roles|max:30',
//                'permissions' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return redirect()->route('admin.create_role')
//                        ->withErrors($validator)
//                        ->withInput();
//            }
//            $role = Role::create(['name' => $data['name']]);
//            $role->syncPermissions($data['permissions']);
//            return redirect()->route('admin.roleslist')->
//                with('status', "Новая роль '$role->name' создана!");
        }
//        $permissions = Permission::all();

        return view('admin.users.create');
    }

    public function editUser(Request $request, User $user) {
        if ($request->isMethod('post')) {
//            $input = $request->all();
//            $validator = Validator::make($input, [
//                'name' => ['required', 'string', 'max:255'],
//                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' .$user->id],
//                'password' => ['required', 'string', 'min:6'],
//                'role' => ['required', 'string'],
//            ]);
//
//            if ($validator->fails()) {
//                return redirect()->route('admin.users.edit', $user->id)
//                    ->withErrors($validator)
//                    ->withInput();
//            }
//
//            $input['password'] = bcrypt($request->get('password'));
//            $user->update($input);
//            $user->syncRoles($request->input('role'));
//
//            return redirect()->route('admin.users.index')->
//            with('status', "Информация о пользователе '$user->name' была обновлена!");
        }

        $roles = Role::get()->pluck('name', 'name');
//        $permissions = Permission::all();
        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Delete user from storage.
     */
    public function deleteUser(User $user) {
        $user->delete();

        return redirect()->route('admin.users.index')->
        with('status', "Пользователь '$user->name' был удален!");
    }

}
