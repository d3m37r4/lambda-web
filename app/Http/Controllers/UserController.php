<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display the specified user profile.
     *
     * @param   User $user
     * @return  View
     */
    public function show(User $user): View
    {
        Session::put('redirect_url', Request::fullUrl());

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user profile.
     *
     * @param   User $user
     * @return  View
     */
    public function edit(User $user): View
    {
        $genders = User::GENDERS;
        $countries = Country::all();

        return view('users.edit', compact('user', 'genders', 'countries'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param   UpdateUserRequest $request
     * @param   User $user
     * @return  RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return back()->with([
            'status' => 'success',
            'message' => 'Ваши изменения сохранены.'
        ]);
    }
}
