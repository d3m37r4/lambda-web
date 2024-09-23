<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use Inertia\Inertia;
use App\Helpers\Token;
use App\Models\GameServer\GameServer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GameServer\StoreRequest;
use App\Http\Requests\Dashboard\GameServer\UpdateRequest;
use App\Http\Requests\Dashboard\GameServer\DestroyRequest;
use App\Http\Requests\Dashboard\GameServer\DeleteSelectedRequest;

class GameServerManagementController extends Controller
{
    /**
     * The number of game servers to return for pagination.
     *
     * @var int
     */
    protected int $perPage = 8;

    /**
     * Display a listing of the game servers.
     */
    public function index()
    {
        return inertia('Dashboard/GameServers/Index', [
            'title' => 'Управление серверами',
            'gameServers' => GameServer::paginate($this->perPage)->through(fn ($gameServer) => [
                'id' => $gameServer->id,
                'name' => $gameServer->name,
                'full_address' => $gameServer->full_address,
                'created_at' => $gameServer->created_at->format('d.m.Y - H:i:s'),
                'updated_at' => $gameServer->updated_at->format('d.m.Y - H:i:s'),
            ])
        ]);
    }

    /**
     * Show the form for creating a new game server.
     */
    public function create()
    {
        return inertia('Dashboard/GameServers/Create', [
            'title' => 'Новый сервер',
            'auth_token' => fn () => Token::generate(GameServer::MAX_AUTH_TOKEN_LENGTH, 'game_servers', 'auth_token')
        ]);
    }

    /**
     * Store a newly created game server in storage.
     */
    public function store(StoreRequest $request)
    {
        $gameServer = GameServer::create($request->validated());

        return redirect()->route('dashboard.game-servers.index', [
            'page' => GameServer::paginate($this->perPage)->lastPage()
        ])->with([
            'status' => 'success',
            'message' => "Сервер \"$gameServer->name\" добавлен."
        ]);
    }

    /**
     * Display the specified game server.
     */
    public function show(GameServer $gameServer)
    {
        return view('admin.servers.show', compact('gameServer'));
    }

    /**
     * Show the form for editing the specified game server.
     */
    public function edit(GameServer $gameServer)
    {
        return inertia('Dashboard/GameServers/Edit', [
            'title' => "Редактирование сервера $gameServer->name",
            'gameServer' => [
                'id' => $gameServer->id,
                'name' => $gameServer->name,
                'ip' => $gameServer->ip,
                'port' => $gameServer->port,
            ],
            'auth_token' => Inertia::lazy(fn () => Token::generate(GameServer::MAX_AUTH_TOKEN_LENGTH, 'game_servers', 'auth_token')),
        ]);
    }

    /**
     * Update the specified game server in storage.
     */
    public function update(UpdateRequest $request, GameServer $gameServer)
    {
        $gameServer->update($request->validated());

        return back()->with([
            'status' => 'success',
            'message' => "Информация о сервере \"$gameServer->name\" обновлена."
        ]);
    }

    /**
     * Remove the specified game server from storage.
     */
    public function destroy(DestroyRequest $request, GameServer $gameServer)
    {
        $validated = $request->validated();
        $gameServer->delete();

        $redirectToPage = min($validated['current_page'], GameServer::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.game-servers.index', [
            'page' => $redirectToPage
        ])->with([
            'status' => 'deleted',
            'message' => "Сервер \"$gameServer->name\" удален."
        ]);
    }

    /**
     * Delete selected game servers from storage.
     */
    public function deleteSelected(DeleteSelectedRequest $request)
    {
        $validated = $request->validated();
        GameServer::whereIn('id', $validated['ids'])->delete();

        $redirectToPage = min($validated['current_page'], GameServer::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.game-servers.index', [
            'page' => $redirectToPage
        ])->with([
            'status' => 'deleted',
            'message' => 'Выбранные серверы удалены.'
        ]);
    }
}
