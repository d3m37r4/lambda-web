<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Country;
use Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Request;
use Session;

class UsersController extends Controller
{

//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        //
//    }

    /**
     * Display the specified user profile.
     *
     * @param  User  $user
     * @return View
     */
    public function show(User $user): View
    {
        Session::put('redirect_url', Request::fullUrl());

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user profile.
     *
     * @param  User  $user
     * @return View
     */
    public function edit(User $user): View
    {
        if (Auth::user()->cannot('update', $user)) {
            abort(403);
        }

        $genders = User::GENDERS;
        $countries = Country::all();

        return view('users.edit', compact('user', 'genders','countries'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        if ($request->user()->cannot('update', $user)) {
            abort(403);
        }

        $user->update($request->safe());

        return redirect()->route('users.show')->with([
            'status' => 'success',
            'message' => 'Ваши изменения сохранены.'
        ]);
    }
}
