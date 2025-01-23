<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeLocaleRequest;

class LocaleController extends Controller
{
    public function __invoke(ChangeLocaleRequest $request)
    {
        $locale = $request->validated('locale');

        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }

        app()->setLocale($locale);
        session()->put('locale', $locale);

        return back()->with([
            'status' => 'success',
            'message' => __('locale.changed', ['locale' => __("locale.$locale")]),
        ]);
    }
}
