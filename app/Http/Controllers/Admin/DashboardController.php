<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('home');
    }
}