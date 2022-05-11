<?php

namespace App\Http\Controllers\Admin;

use App\Models\AccessGroup;
use App\Models\Server;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAccessGroupRequest;
//use App\Http\Requests\UpdateAccessGroupRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccessGroupsManagementController extends Controller
{
    /**
     * Show the form for creating a new access group.
     *
     * @param Server $server
     * @return View
     */
    public function create(Server $server): View
    {
        return view('admin.servers.access-groups.create', compact('server'));
    }

    /**
     * Store a newly created access group in storage.
     *
     * @param StoreAccessGroupRequest $request
     * @param Server $server
     * @return RedirectResponse
     */
    public function store(StoreAccessGroupRequest $request, Server $server): RedirectResponse
    {
        $accessGroup = AccessGroup::create($request->all());

        return redirect()->route('admin.servers.show', $server->id)->with([
            'status' => 'success',
            'message' => "Группа доступов {$accessGroup->title} успешно добавлена!"
        ]);
    }

    /**
     * Show the form for editing the specified access group.
     *
     * @param Server $server
     * @param AccessGroup $accessGroup
     * @return View
     */
    public function edit(Server $server, AccessGroup $accessGroup): View
    {
        return view('admin.servers.access-groups.edit', compact('server', 'accessGroup'));
    }

    /**
     * Update the specified access group in storage.
     *
     * @param Request $request
     * @param Server $server
     * @param AccessGroup $accessGroup
     * @return RedirectResponse
     */
    public function update(Request $request, Server $server, AccessGroup $accessGroup): RedirectResponse
    {
        $accessGroup->update($request->all());

        return back()->with([
            'status' => 'success',
            'message' => "Информация о группе доступа {$accessGroup->title} успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified access from storage.
     *
     * @param Server $server
     * @param AccessGroup $accessGroup
     * @return RedirectResponse
     */
    public function destroy(Server $server, AccessGroup $accessGroup): RedirectResponse
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
            'message' => "Группа доступа {$accessGroup->title} удалена!"
        ]);
    }
}
