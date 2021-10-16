<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.settings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
//        dd($request);

        config(['app.name' => $request->input('name')]);

//        $request->whenHas('admin_dir', function ($value) {
//            config(['app.admin_dir' => $value]);
//        });

        return back()->with([
            'status' => 'success',
            'message' => "Настройки системы были успешно обновлены!"
        ]);
    }
}
