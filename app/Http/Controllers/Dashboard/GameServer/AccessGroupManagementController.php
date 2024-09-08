<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GameServer\AccessGroup\StoreRequest;
use App\Models\GameServer\AccessGroup;
use App\Models\GameServer\GameServer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

//use App\Http\Requests\UpdateRequest;

class AccessGroupManagementController extends Controller
{
    /**
     * Show the form for creating a new access group.
     *
     * @param GameServer $server
     * @return View
     */
    public function create(GameServer $server): View
    {
        return view('admin.servers.access-groups.create', compact('server'));
    }

    /**
     * Store a newly created access group in storage.
     *
     * @param StoreRequest $request
     * @param GameServer $server
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, GameServer $server): RedirectResponse
    {
        $accessGroup = AccessGroup::create($request->all());

        return redirect()->route('admin.servers.show', $server->id)->with([
            'status' => 'success',
            'message' => "Группа доступов \"$accessGroup->title\" успешно добавлена!"
        ]);
    }

    /**
     * Show the form for editing the specified access group.
     *
     * @param GameServer $server
     * @param AccessGroup $accessGroup
     * @return View
     */
    public function edit(GameServer $server, AccessGroup $accessGroup): View
    {
        return view('admin.servers.access-groups.edit', compact('server', 'accessGroup'));
    }

    /**
     * Update the specified access group in storage.
     *
     * @param Request $request
     * @param GameServer $server
     * @param AccessGroup $accessGroup
     * @return RedirectResponse
     */
    public function update(Request $request, GameServer $server, AccessGroup $accessGroup): RedirectResponse
    {
        $accessGroup->update($request->all());

        return back()->with([
            'status' => 'success',
            'message' => "Информация о группе доступа \"$accessGroup->title\" успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified access from storage.
     *
     * @param GameServer $server
     * @param AccessGroup $accessGroup
     * @return RedirectResponse
     */
    public function destroy(GameServer $server, AccessGroup $accessGroup): RedirectResponse
    {
        if (!$server) {
            return back()->with([
                'status' => 'danger',
                'message' => 'Ошибка!'
            ]);
        }

        $accessGroup->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Группа доступа \"$accessGroup->title\" удалена!"
        ]);
    }
}
