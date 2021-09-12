<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reason;
use App\Models\Server;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReasonRequest;
use App\Http\Requests\UpdateReasonRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReasonsManagementController extends Controller {
    /**
     * Show the form for creating a new reason.
     *
     * @param Server $server
     * @return View
     */
    public function create(Server $server): View {
        return view('admin.servers.reasons.create', compact('server'));
    }

    /**
     * Store a newly created reason in storage.
     *
     * @param StoreReasonRequest $request
     * @param Server $server
     * @return RedirectResponse
     */
    public function store(StoreReasonRequest $request, Server $server): RedirectResponse {
        $reason = Reason::create($request->safe()->except('months', 'days', 'hours', 'minutes'));

        return redirect()->route('admin.servers.show', $server->id)->with([
            'status' => 'success',
            'message' => "Причина наказания {$reason->title} успешно добавлена!"
        ]);
    }

    /**
     * Show the form for editing the specified reason.
     *
     * @param Server $server
     * @param Reason $reason
     * @return View
     */
    public function edit(Server $server, Reason $reason): View {
        return view('admin.servers.reasons.edit', compact('server', 'reason'));
    }

    /**
     * Update the specified reason in storage.
     *
     * @param UpdateReasonRequest $request
     * @param Server $server
     * @param Reason $reason
     * @return RedirectResponse
     */
    public function update(UpdateReasonRequest $request, Server $server, Reason $reason): RedirectResponse {
        $reason->update($request->safe()->except('months', 'days', 'hours', 'minutes'));

        return back()->with([
            'status' => 'success',
            'message' => "Информация о причине наказания {$reason->title} успешно обновлена!"
        ]);
    }

    /**
     * Remove the specified reason from storage.
     *
     * @param Server $server
     * @param Reason $reason
     * @return RedirectResponse
     */
    public function destroy(Server $server, Reason $reason): RedirectResponse {
        if (!$server) {
            return back()->with([
                'status' => 'danger',
                'message' => 'Ошибка!'
            ]);
        }

        $reason->delete();

        return back()->with([
            'status' => 'success',
            'message' => "Причина {$reason->title} удалена!"
        ]);
    }
}
