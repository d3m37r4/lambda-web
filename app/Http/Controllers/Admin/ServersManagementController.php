<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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
     * @return Application|Factory|View|Response
     */
    public function create() {
        $redirect = $this->getPreviousUrl(action([ServersManagementController::class, 'index']));
        return view('admin.servers.create', compact('redirect'));
    }

    /**
     * Store a newly created server in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:servers'],
            'ip' => ['required', 'ip'],
            'port' => ['required', 'integer', 'between:1,65535'],
        ];

        $rconCheck = !empty($request->input('rcon'));
        if ($rconCheck) {
            $rules['rcon'] = ['string', 'max:128'];
        }

//        TODO: Add IP+port pair verification
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $authTokenHash = Hash::make($request->input('auth_token'));
        if (!$this->checkAuthTokenUniqueByHash($authTokenHash)) {
            return $this->redirectBack();
        }

        $server = Server::create([
            'name' => strip_tags($request->input('name')),
            'ip' => $request->input('ip'),
            'port' => $request->input('port'),
            'rcon' => $request->input('rcon'),
            'auth_token' => $authTokenHash,
        ]);

        return redirect()
            ->route('admin.servers.index')
            ->with('status', 'success')
            ->with('message', "Сервер {$server->name} успешно добавлен!");
    }

    /**
     * Display the specified server.
     *
     * @param Server $server
     * @return Application|Factory|View|Response
     */
    public function show(Server $server) {
        $redirect = $this->getPreviousUrl(action([ServersManagementController::class, 'index']));
        $reasons = $server->reasons;

        return view('admin.servers.show', compact('server', 'reasons', 'redirect'));
    }

    /**
     * Show the form for editing the specified server.
     *
     * @param Server $server
     * @return Application|Factory|View|Response
     */
    public function edit(Server $server) {
        return view('admin.servers.edit', compact('server'));
    }

    /**
     * Update the specified server in storage.
     *
     * @param  Request  $request
     * @param Server $server
     * @return RedirectResponse
     */
    public function update(Request $request, Server $server): RedirectResponse {
        $nameCheck = !empty($request->input('name')) && ($request->input('name') != $server->name);
        $ipCheck = !empty($request->input('ip')) && ($request->input('ip') != $server->ip);
        $portCheck = !empty($request->input('port')) && ($request->input('port') != $server->port);

        if ($nameCheck) {
            $rules['name'] = ['required', 'string', 'max:255', 'unique:servers'];
        }

        if ($ipCheck) {
            $rules['ip'] = ['required', 'ip'];
        }

        if ($portCheck) {
            $rules['port'] = ['required', 'integer', 'between:1,65535'];
        }

        if (isset($rules)) {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }

        if ($nameCheck) {
            $server->name = strip_tags($request->input('name'));
        }

        if ($ipCheck) {
            $server->ip = $request->input('ip');
        }

        if ($portCheck) {
            $server->port = $request->input('port');
        }

        $authTokenHash = Hash::make($request->input('auth_token'));
        if ($this->checkAuthTokenUniqueByHash($authTokenHash)) {
            $server->auth_token = $authTokenHash;
        } else {
            return $this->redirectBack();
        }

        $server->rcon = $request->input('rcon');
        $server->save();

        return back()
            ->with('status', 'success')
            ->with('message', "Информация о сервере {$server->name} успешно обновлена!");
    }

    /**
     * Remove the specified server from storage.
     *
     * @param Server $server
     * @return RedirectResponse
     */
    public function destroy(Server $server): RedirectResponse {
        $server->delete();
        return back()
            ->with('status', 'success')
            ->with('message', "Сервер {$server->name} удален!");
    }

    /**
     * Checks uniqueness of token by hash.
     * If record is not found, it returns true, otherwise false.
     *
     * @param $hash
     * @return bool
     */
    protected function checkAuthTokenUniqueByHash($hash): bool {
        return (bool)Server::where('auth_token', $hash)->doesntExist();
    }

    /**
     * Redirects to previous page and shows notification.
     *
     * @return RedirectResponse
     */
    protected function redirectBack(): RedirectResponse {
        return back()
            ->with('status', 'danger')
            ->with('message', "Токен уже используется системой! Пожалуйста, сгенерируйте новый токен.");
    }

    /**
     * Gets previous url or, if previous url is equal to current one, sets desired standard value
     *
     * @param string $defaultUrl
     * @return string
     */
    function getPreviousUrl(string $defaultUrl): string {
        $previous = URL::previous();
        return (($previous !== URL::current()) ? $previous : $defaultUrl);
    }
}
