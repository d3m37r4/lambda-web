<?php

namespace App\Http\Controllers\Admin;

use App\Models\Access;
use App\Models\Server;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreAccessRequest;
//use App\Http\Requests\UpdateAccessRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccessesManagementController extends Controller
{
    /**
     * Show the form for creating a new access.
     *
     * @param Server $server
     * @return View
     */
    public function create(Server $server): View
    {
        return view('admin.servers.accesses.create', compact('server'));
    }

    /**
     * Store a newly created access in storage.
     *
     * @param Request $request
     * @param Server $server
     * @return RedirectResponse
     */
    public function store(Request $request, Server $server): RedirectResponse
    {
        $access = Access::create($request->all());

        return redirect()->route('admin.servers.show', $server->id)->with([
            'status' => 'success',
            'message' => "Доступ {$access->key} успешно добавлен!"
        ]);
    }

    /**
     * Show the form for editing the specified access.
     *
     * @param Server $server
     * @param Access $access
     * @return View
     */
    public function edit(Server $server, Access $access): View
    {
        return view('admin.servers.accesses.edit', compact('server', 'access'));
    }

    /**
     * Update the specified access in storage.
     *
     * @param Request $request
     * @param Server $server
     * @param Access $access
     * @return RedirectResponse
     */
    public function update(Request $request, Server $server, Access $access): RedirectResponse
    {
        $access->update($request->all());

        return back()->with([
            'status' => 'success',
            'message' => "Информация о доступе {$access->key} успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified access from storage.
     *
     * @param Server $server
     * @param Access $access
     * @return RedirectResponse
     */
    public function destroy(Server $server, Access $access): RedirectResponse
    {
        if (!$server) {
            return back()->with([
                'status' => 'danger',
                'message' => 'Ошибка!'
            ]);
        }

        $access->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Доступ {$access->key} удален!"
        ]);
    }
}
