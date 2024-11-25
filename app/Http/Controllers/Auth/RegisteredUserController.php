<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return Inertia::render('Auth/Register', [
            'title' => 'Регистрация'
        ]);
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
