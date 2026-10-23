<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function dashboard(): RedirectResponse
    {
        return redirect()->route('lapor-banjir.index');
    }

    public function profile(): View
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }
}
