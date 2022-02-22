<?php

namespace App\Http\Controllers\Admin;

use Request;
use Session;
use App\Models\Server;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServersManagementController extends Controller
{
    /**
     * Display a listing of the servers.
     *
     * @return View
     */
    public function index(): View
    {
        $servers = Server::paginate(env('PAGINATION_SIZE'));

        Session::put('redirect_url', Request::fullUrl());

        return view('admin.servers.index', compact('servers'));
    }

    /**
     * Show the form for creating a new server.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.servers.create');
    }

    /**
     * Store a newly created server in storage.
     *
     * @param StoreServerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreServerRequest $request): RedirectResponse
    {
        $server = Server::create($request->validated());

        return redirect(session('redirect_url'))->with([
            'status' => 'success',
            'message' => "Сервер {$server->name} успешно добавлен!"
        ]);
    }

    /**
     * Display the specified server.
     *
     * @param Server $server
     * @return View
     */
    public function show(Server $server): View
    {
        return view('admin.servers.show', compact('server'));
    }

    /**
     * Show the form for editing the specified server.
     *
     * @param Server $server
     * @return View
     */
    public function edit(Server $server): View
    {
        return view('admin.servers.edit', compact('server'));
    }

    /**
     * Update the specified server in storage.
     *
     * @param UpdateServerRequest $request
     * @param Server $server
     * @return RedirectResponse
     */
    public function update(UpdateServerRequest $request, Server $server): RedirectResponse
    {
        $server->update($request->validated());

        return back()->with([
            'status' => 'success',
            'message' => "Информация о сервере {$server->name} успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified server from storage.
     *
     * @param Server $server
     * @return RedirectResponse
     */
    public function destroy(Server $server): RedirectResponse
    {
        $server->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Сервер {$server->name} удален!"
        ]);
    }
}
