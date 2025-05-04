<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('user.dashboard.index');
    }
}