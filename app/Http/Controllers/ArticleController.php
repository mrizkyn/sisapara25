<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userId = $request->user()->id;
            $articles = Article::join('users', 'articles.user_id', '=', 'users.id')
                ->select([
                    'articles.id',
                    'articles.slug',
                    'articles.title',
                    'users.name as user_name',
                    'articles.created_at'
                ])
                ->where('articles.user_id', $userId)
                ->orderBy('articles.created_at', 'desc')
                ->get()
                ->map(function ($article, $index) {
                    $article->no = $index + 1;
                    return $article;
                });

            return DataTables::of($articles)
                ->editColumn('created_at', fn($a) => Carbon::parse($a->created_at)->format('Y-m-d'))
                ->addColumn('action', function ($article) {
                    return '
                        <a href="' . route('superadmin.articles.edit', $article->slug) . '" class="btn btn-primary btn-sm">Edit</a>
                        <a href="' . route('superadmin.articles.show', $article->slug) . '" class="btn btn-info btn-sm">Detail</a>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $article->slug . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('superadmin.articles.index');
    }

    public function create()
    {
        return view('superadmin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $content = $request->input('content');
        if (trim(strip_tags($content)) === '') {
            return back()->withErrors(['content' => 'Deskripsi artikel tidak boleh kosong.'])->withInput();
        }

        $validated['user_id'] = $request->user()->id;
        $validated['content'] = $content;

        if ($request->hasFile('image')) {
            $validated['image'] = $this->processImage($request->file('image'));
        }

        Article::create($validated);

        return to_route('superadmin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $article = Article::with('user:id,name')->where('slug', $slug)->firstOrFail();
        return view('superadmin.articles.show', compact('article'));
    }

    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('superadmin.articles.edit', compact('article'));
    }

    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $validated['image'] = $this->processImage($request->file('image'));
        }

        $article->update($validated);

        return to_route('superadmin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        if ($article->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk menghapus artikel ini.'], 403);
        }

        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return response()->json(['success' => 'Artikel berhasil dihapus.']);
    }


    private function processImage($image)
    {
        $imageData = Image::read($image);
        $quality = 75;
        do {
            $encodedImage = $imageData->toJpeg($quality);
            $fileSize = strlen($encodedImage);
            $quality -= 5;
        } while ($fileSize > 300 * 1024 && $quality > 50);

        $filename = 'articles/' . now()->format('Ymd_His') . '_' . uniqid() . '.jpg';
        Storage::disk('public')->put($filename, $encodedImage);

        return $filename;
    }
}
