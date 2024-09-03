<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use App\Http\Controllers\Controller;
use App\Models\GameServer\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayerManagementController extends Controller
{
    /**
     * Show the form for editing the specified player.
     *
     * @param Player $player
     * @return Response
     */
    public function edit(Player $player): Response
    {
        //
    }

    /**
     * Update the specified player in storage.
     *
     * @param Request $request
     * @param Player $player
     * @return Response
     */
    public function update(Request $request, Player $player): Response
    {
        //
    }

    /**
     * Remove the specified player from storage.
     *
     * @param Player $player
     * @return Response
     */
    public function destroy(Player $player): Response
    {
        //
    }
}
