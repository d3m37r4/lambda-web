<?php

namespace App\Http\Controllers\Auth_laravel_ui;

use Auth;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\UpdateUserRegister2StepRequest;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterStep2Controller extends Controller
{
    /**
     * Display registration completion form and filling in additional user data.
     *
     * @return  View
     */
    public function showStep2Form(): View
    {
        $user = Auth::user();
        $genders = User::GENDERS;
        $countries = Country::all();

        return view('auth.register-step2', compact('user', 'genders', 'countries'));
    }

    /**
     * Update user's personal information when submitting form of registration step 2.
     *
     * @param   UpdateUserRegister2StepRequest $request
     * @return  RedirectResponse
     */
    public function postStep2Form(UpdateUserRegister2StepRequest $request): RedirectResponse
    {
        Auth::user()->update($request->validated());

        return redirect('/')->with([
            'status' => 'success',
            'message' => 'Ваши изменения сохранены.'
        ]);
    }
}
