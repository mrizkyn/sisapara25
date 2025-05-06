<?php

namespace App\Http\Controllers;

use App\Models\Facility;
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
        $facilities = Facility::select(['id', 'name', 'thumbnail_image', 'capacity'])->get();
        return view('landing.reservasi', compact('facilities'));
    }
    public function reservasiShow()
    {
        $facilities = Facility::select(['id', 'description', 'image', 'capacity'])->get();
        return view('landing.reservasi', compact('facilities'));
    }


    public function faq()
    {
        return view('landing.faq');
    }
}
