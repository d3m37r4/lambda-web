<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesManagementController extends Controller {
    /**
     * Display a listing of the roles.
     *
     * @return Application|Factory|View|Response
     */
    public function index() {
        $roles = Role::all();

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
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role = Role::create([
            'name' => strip_tags($request->input('name')),
        ]);
        $role->givePermissionTo($request->input('permissions'));
        $role->save();

        return redirect()
            ->route('admin.roles.index')
            ->with('type', 'success')
            ->with('status', "Новая роль {$role->name} успешно создана!");
    }

    /**
     * Display the specified role.
     *
     * @param Role $role
     * @return Response
     */
    public function show(Role $role): Response {
        //
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role): Response {
        //
    }

    /**
     * Update the specified role in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return Response
     */
    public function update(Request $request, Role $role): Response {
        //
    }

    /**
     * Remove the specified role from storage.
     *
     * @param Role $role
     * @return Response
     */
    public function destroy(Role $role): Response {
        //
    }
}
