<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home()
    {
        return view('landing.home');
    }

    public function informasi()
    {
        return view('landing.informasi');
    }

    public function reservasi()
    {
        return view('landing.reservasi');
    }

    public function faq()
    {
        return view('landing.faq');
    }
}
