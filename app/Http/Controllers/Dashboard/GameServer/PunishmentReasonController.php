<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use App\Models\GameServer\PunishmentReason;
use App\Models\GameServer\GameServer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GameServer\PunishmentReason\StoreRequest;
use App\Http\Requests\Dashboard\GameServer\PunishmentReason\UpdateRequest;

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
     * Show the form for editing the specified punishment reason.
     */
    public function edit(GameServer $gameServer, PunishmentReason $punishmentReason)
    {
        return inertia('Dashboard/GameServers/PunishmentReasons/Edit', [
            'title' => "Редактирование причины $punishmentReason->name",
            'gameServer' => $gameServer->only('id'),
            'punishmentReason' => [
                'id' => $punishmentReason->id,
                'name' => $punishmentReason->name,
                'months' => $punishmentReason->formatTime('%m'),
                'days' => $punishmentReason->formatTime('%d'),
                'hours' => $punishmentReason->formatTime('%h'),
                'minutes' => $punishmentReason->formatTime('%i'),
            ]
        ]);
    }

    /**
     * Update the specified punishment reason in storage.
     */
    public function update(UpdateRequest $request, GameServer $gameServer, PunishmentReason $punishmentReason)
    {
        $punishmentReason->update($request->safe()->except('id', 'months', 'days', 'hours', 'minutes'));

        return back()->with([
            'status' => 'success',
            'message' => "Информация о причине наказания \"$punishmentReason->name\" обновлена!"
        ]);
    }

    /**
     * Remove the specified punishment reason from storage.
     */
    public function destroy(GameServer $gameServer, PunishmentReason $punishmentReason)
    {
        $punishmentReason->delete();

        return back()->with([
            'status' => 'deleted',
            'message' => "Причина \"$punishmentReason->name\" удалена."
        ]);
    }
}
