<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'title' => 'Регистрация аккаунта'
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());
        $user->assignRole(User::DEFAULT_USER_ROLE);     // TODO: Move default role assignment to new user registration event handler.

        event(new Registered($user));
        Auth::login($user);

        return redirect('/');
    }
}
