<?php

namespace App\Http\Controllers\Dashboard\GameServer;

use App\Models\GameServer\GameServer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GameServer\StoreRequest;
use App\Http\Requests\Dashboard\GameServer\UpdateRequest;
use App\Http\Requests\Dashboard\GameServer\DestroyRequest;
use App\Http\Requests\Dashboard\GameServer\DeleteSelectedRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

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
            'game_servers' => GameServer::paginate($this->perPage)->through(fn ($server) => [
                'id' => $server->id,
                'name' => $server->name,
                'full_address' => $server->full_address,
                'created_at' => $server->created_at->format('d.m.Y - H:i:s'),
                'updated_at' => $server->updated_at->format('d.m.Y - H:i:s'),
            ])
        ]);
    }

    /**
     * Show the form for creating a new game server.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.servers.create');
    }

    /**
     * Store a newly created game server in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $server = GameServer::create($request->validated());

        return redirect(session('redirect_url'))->with([
            'status' => 'success',
            'message' => "Сервер \"$server->name\" успешно добавлен!"
        ]);
    }

    /**
     * Display the specified game server.
     *
     * @param GameServer $server
     * @return View
     */
    public function show(GameServer $server): View
    {
        return view('admin.servers.show', compact('server'));
    }

    /**
     * Show the form for editing the specified game server.
     *
     * @param GameServer $server
     * @return View
     */
    public function edit(GameServer $server): View
    {
        return view('admin.servers.edit', compact('server'));
    }

    /**
     * Update the specified game server in storage.
     *
     * @param UpdateRequest $request
     * @param GameServer $server
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, GameServer $server): RedirectResponse
    {
        $server->update($request->validated());

        return back()->with([
            'status' => 'success',
            'message' => "Информация о сервере \"$server->name\" успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified game server from storage.
     */
    public function destroy(DestroyRequest $request, GameServer $server): RedirectResponse
    {
        $validated = $request->validated();
        $server->delete();

        $redirectToPage = min($validated['current_page'], GameServer::paginate($this->perPage)->lastPage());

        return redirect()->route('dashboard.game-servers.index', ['page' => $redirectToPage])
            ->with([
                'status' => 'deleted',
                'message' => "Сервер \"$server->name\" удален!"
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

        return redirect()->route('dashboard.game-servers.index', ['page' => $redirectToPage])
            ->with([
                'status' => 'deleted',
                'message' => 'Выбранные игровые серверы удалены.'
            ]);
    }
}
