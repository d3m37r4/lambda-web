<?php /** @noinspection PhpVoidFunctionResultUsedInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reason;
use App\Models\Server;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReasonsManagementController extends Controller {
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
//    public function create() {
//
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
//    public function store(Request $request) {
//
//    }

    /**
     * Display the specified resource.
     *
     * @param Reason $reason
     * @return Response
     */
//    public function show(Reason $reason) {
//        dd($reason);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Server $server
     * @param Reason $reason
     * @return Response
     */
//    public function edit(Server $server, Reason $reason) {
//        dd($reason);
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reason $reason
     * @return Response
     */
//    public function update(Request $request, Reason $reason) {
//
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Server $server
     * @param Reason $reason
     * @return RedirectResponse|void
     */
    public function destroy(Server $server, Reason $reason): RedirectResponse {
        if (!$server) {
            return abort(500);
        }

        $reason->delete();
        return back()
            ->with('status', 'success')
            ->with('message', "Причина {$reason->name} удалена!");
    }
}
