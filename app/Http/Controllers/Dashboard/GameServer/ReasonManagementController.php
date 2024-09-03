<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReasonRequest;
use App\Http\Requests\Admin\UpdateReasonRequest;
use App\Models\GameServer\GameServer;
use App\Models\GameServer\Reason;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReasonManagementController extends Controller
{
    /**
     * Show the form for creating a new reason.
     *
     * @param GameServer $server
     * @return View
     */
    public function create(GameServer $server): View
    {
        return view('admin.servers.reasons.create', compact('server'));
    }

    /**
     * Store a newly created reason in storage.
     *
     * @param StoreReasonRequest $request
     * @param GameServer $server
     * @return RedirectResponse
     */
    public function store(StoreReasonRequest $request, GameServer $server): RedirectResponse
    {
        $reason = Reason::create($request->safe()->except('months', 'days', 'hours', 'minutes'));

        return redirect()->route('admin.servers.show', $server->id)->with([
            'status' => 'success',
            'message' => "Причина наказания \"$reason->title\" успешно добавлена!"
        ]);
    }

    /**
     * Show the form for editing the specified reason.
     *
     * @param GameServer $server
     * @param Reason $reason
     * @return View
     */
    public function edit(GameServer $server, Reason $reason): View
    {
        return view('admin.servers.reasons.edit', compact('server', 'reason'));
    }

    /**
     * Update the specified reason in storage.
     *
     * @param UpdateReasonRequest $request
     * @param GameServer $server
     * @param Reason $reason
     * @return RedirectResponse
     */
    public function update(UpdateReasonRequest $request, GameServer $server, Reason $reason): RedirectResponse
    {
        $reason->update($request->safe()->except('months', 'days', 'hours', 'minutes'));

        return back()->with([
            'status' => 'success',
            'message' => "Информация о причине наказания \"$reason->title\" успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified reason from storage.
     *
     * @param GameServer $server
     * @param Reason $reason
     * @return RedirectResponse
     */
    public function destroy(GameServer $server, Reason $reason): RedirectResponse
    {
        if (!$server) {
            return back()->with([
                'status' => 'danger',
                'message' => 'Ошибка!'
            ]);
        }

        $reason->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Причина \"$reason->title\" удалена!"
        ]);
    }
}
