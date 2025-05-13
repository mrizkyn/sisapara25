<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Facility;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home()
    {
        $facilities = Facility::select(['id', 'image', 'name'])->latest()->take(5)->get();
        return view('landing.home', compact('facilities'));
    }

    public function informasi()
    {
        $latest = Article::select('id', 'title', 'content', 'image', 'user_id')
            ->with('user:id,name')
            ->latest()
            ->first();

        $others = Article::select('id', 'title', 'user_id')
            ->with('user:id,name')
            ->latest()
            ->skip(1)
            ->take(7)
            ->get();

        return view('landing.informasi', compact('latest', 'others'));
    }

    public function showArticle($id)
    {
        $article = Article::findOrFail($id);

        $otherArticles = Article::select('id', 'title', 'user_id')
            ->with('user:id,name')
            ->where('id', '!=', $id)
            ->latest()
            ->paginate(7);
        return view('landing.article.show', compact('article', 'otherArticles'));
    }




    public function reservasi()
    {
        $facilities = Facility::select(['id', 'name', 'image', 'capacity'])
            ->latest()
            ->get();
        return view('landing.reservasi', compact('facilities'));
    }

    public function jadwalReservasi()
    {
        $events = Reservation::select('id', 'user_id', 'facility_id', 'time_start', 'time_end', 'purpose')
            ->with(['user:id,name', 'facility:id,name'])
            ->where('status', 'approved')
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->user->name,
                    'start' => Carbon::parse($item->time_start)->format('Y-m-d H:i'),
                    'end'   => Carbon::parse($item->time_end)->format('Y-m-d H:i'),
                    'extendedProps' => [
                        'purpose' => $item->purpose,
                        'facility' => optional($item->facility)->name,
                    ],
                ];
            });

        return response()->json($events);
    }

    public function reservasiShow($id)
    {
        $facility = Facility::findOrFail($id);
        return view('landing.reservasi-show', compact('facility'));
    }


    public function faq()
    {
        return view('landing.faq');
    }
}
