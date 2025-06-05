<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Equipment;
use App\Models\Facility;
use App\Models\Reservation;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function home()
    {
        $facilities = Facility::select(['banner', 'name'])->inRandomOrder()->take(5)->get();
        $equipments = Equipment::select(['image', 'name'])->inRandomOrder()->take(5)->get();
        return view('landing.home', compact('facilities', 'equipments'));
    }

    public function informasi()
    {
        $facilities = Facility::select(['name', 'banner', 'capacity'])
            ->inRandomOrder()
            ->take(6)
            ->get();

        $equipments = Equipment::select(['name', 'image'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        $latest = Article::select('id', 'slug', 'title', 'content', 'image', 'user_id')
            ->with('user:id,name')
            ->latest()
            ->first();

        $others = Article::select('id', 'slug', 'title', 'user_id')
            ->with('user:id,name')
            ->latest()
            ->skip(1)
            ->take(7)
            ->get();

        return view('landing.informasi', compact('latest', 'others', 'facilities', 'equipments'));
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $otherArticles = Article::select('id', 'title', 'user_id', 'slug')
            ->with('user:id,name')
            ->where('slug', '!=', $slug)
            ->latest()
            ->paginate(7);

        return view('landing.article.show', compact('article', 'otherArticles'));
    }

    public function reservasi(Request $request)
    {
        $facilities = Facility::select(['id', 'name', 'banner', 'capacity'])
            ->inRandomOrder()
            ->get();



        $equipments = Equipment::select(['id', 'name', 'quantity', 'image'])
            ->inRandomOrder()
            ->get();

        return view('landing.reservasi', compact('facilities', 'equipments'));
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
