<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServersManagementController extends Controller {
    /**
     * Display a listing of the servers.
     *
     * @return Application|Factory|View|Response
     */
    public function index() {
        $servers = Server::paginate(env('PAGINATION_SIZE'));

        return view('admin.servers.index', compact('servers'));
    }

    /**
     * Show the form for creating a new server.
     *
     * @return Response
     */
//    public function create()
//    {
//
//    }

    /**
     * Store a newly created server in storage.
     *
     * @param  Request  $request
     * @return Response
     */
//    public function store(Request $request)
//    {
//
//    }

    /**
     * Display the specified server.
     *
     * @param Server $server
     * @return Response
     */
//    public function show(Server $server)
//    {
//
//    }

    /**
     * Show the form for editing the specified server.
     *
     * @param Server $server
     * @return Response
     */
//    public function edit(Server $server)
//    {
//
//    }

    /**
     * Update the specified server in storage.
     *
     * @param  Request  $request
     * @param Server $server
     * @return Response
     */
//    public function update(Request $request, Server $server)
//    {
//
//    }

    /**
     * Remove the specified server from storage.
     *
     * @param Server $server
     * @return Response
     */
//    public function destroy(Server $server)
//    {
//
//    }
}
