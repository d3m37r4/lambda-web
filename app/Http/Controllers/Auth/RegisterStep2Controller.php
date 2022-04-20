<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RegisterStep2Controller extends Controller
{
    public function showStep2Form()
    {
        $countries = Country::all();
        return view('auth.register-step2', compact('countries'));
    }

    public function postStep2Form(Request $request): RedirectResponse
    {
        Auth::user()->update(
            $request->only([
                'biography',
                'country_id',
            ])
        );

        return redirect()->route('home');
    }
}
