<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Player;
use App\Models\Server;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayersManagementController extends Controller
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
