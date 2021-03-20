<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $usersCount = User::all()->count();

        return view('admin.home.index', compact('usersCount'));
    }
}
