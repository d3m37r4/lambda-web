<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use App\Http\Controllers\Controller;
use App\Models\GameServer\Access;
use App\Models\GameServer\GameServer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

//use App\Http\Requests\StoreAccessRequest;
//use App\Http\Requests\UpdateAccessRequest;

class AccessManagementController extends Controller
{
    /**
     * Show the form for creating a new access.
     *
     * @param GameServer $server
     * @return View
     */
    public function create(GameServer $server): View
    {
        return view('admin.servers.accesses.create', compact('server'));
    }

    /**
     * Store a newly created access in storage.
     *
     * @param Request $request
     * @param GameServer $server
     * @return RedirectResponse
     */
    public function store(Request $request, GameServer $server): RedirectResponse
    {
        $access = Access::create($request->all());

        return redirect()->route('admin.servers.show', $server->id)->with([
            'status' => 'success',
            'message' => "Доступ \"$access->key\" успешно добавлен!"
        ]);
    }

    /**
     * Show the form for editing the specified access.
     *
     * @param GameServer $server
     * @param Access $access
     * @return View
     */
    public function edit(GameServer $server, Access $access): View
    {
        return view('admin.servers.accesses.edit', compact('server', 'access'));
    }

    /**
     * Update the specified access in storage.
     *
     * @param Request $request
     * @param GameServer $server
     * @param Access $access
     * @return RedirectResponse
     */
    public function update(Request $request, GameServer $server, Access $access): RedirectResponse
    {
        $access->update($request->all());

        return back()->with([
            'status' => 'success',
            'message' => "Информация о доступе \"$access->key\" успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified access from storage.
     *
     * @param GameServer $server
     * @param Access $access
     * @return RedirectResponse
     */
    public function destroy(GameServer $server, Access $access): RedirectResponse
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
            'message' => "Доступ \"$access->key\" удален!"
        ]);
    }
}
