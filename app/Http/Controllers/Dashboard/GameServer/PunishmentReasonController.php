<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GameServer\PunishmentReason\StoreRequest;
use App\Http\Requests\Dashboard\GameServer\PunishmentReason\UpdateRequest;
use App\Models\GameServer\GameServer;
use App\Models\GameServer\PunishmentReason;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Request;

class PunishmentReasonController extends Controller
{
    /**
     * Show the form for creating a new punishment reason.
     */
    public function create(GameServer $gameServer)
    {
        return inertia('Dashboard/GameServers/PunishmentReasons/Create', [
            'title' => 'Новая причина наказания',
            'gameServer' => $gameServer->only('id'),
        ]);
    }

    /**
     * Store a newly created punishment reason in storage.
     */
    public function store(StoreRequest $request, GameServer $gameServer)
    {
        $punishmentReason = PunishmentReason::create($request->safe()
            ->except('months', 'days', 'hours', 'minutes'));

        return redirect()->route('dashboard.game-servers.show', $gameServer)->with([
            'status' => 'success',
            'message' => "Причина наказания \"$punishmentReason->name\" добавлена!"
        ]);
    }

    /**
     * Show the form for editing the specified reason.
     *
     * @param GameServer $server
     * @param PunishmentReason $reason
     * @return View
     */
    public function edit(GameServer $server, PunishmentReason $reason): View
    {
        return view('admin.servers.reasons.edit', compact('server', 'reason'));
    }

    /**
     * Update the specified reason in storage.
     *
     * @param UpdateRequest $request
     * @param GameServer $server
     * @param PunishmentReason $reason
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, GameServer $server, PunishmentReason $reason): RedirectResponse
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
     * @param PunishmentReason $reason
     * @return RedirectResponse
     */
    public function destroy(GameServer $server, PunishmentReason $reason): RedirectResponse
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
