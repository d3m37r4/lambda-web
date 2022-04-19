<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

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
        if(Auth::user()->id != $user->id) {
            abort(404);
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  User  $user
     * @return Response
     */
    public function update(Request $request, User $user): Response
    {
        //
    }
}
