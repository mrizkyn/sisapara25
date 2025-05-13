<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard.index');
    }

    public function speradminDashboard()
    {
        return view('superadmin.dashboard.index');
    }

    public function userDashboard()
    {
        $user = Auth::user();
        return view('user.dashboard.index', compact('user'));
    }
}
