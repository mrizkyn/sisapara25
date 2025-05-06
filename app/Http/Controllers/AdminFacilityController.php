<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Yajra\DataTables\DataTables;

class AdminFacilityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $facilities = Facility::join('users', 'facilities.user_id', '=', 'users.id')
                ->select([
                    'facilities.id',
                    'facilities.name',
                    'facilities.description',
                    'facilities.type',
                    'facilities.user_id',
                    'users.name as user_name'
                ])
                ->get();

            return DataTables::of($facilities)
                ->editColumn('user_name', function ($facility) {
                    return $facility->user_name ?? '-';
                })
                ->addColumn('action', function ($facility) {
                    return '<a href="' . route('admin.facilities.edit', $facility->id) . '" class="btn btn-primary btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="' . $facility->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.facilities.index');
    }
    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'type'        => 'required|string|max:100',
            'capacity'    => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = date('Y-m-d_His') . '-' . $imageFile->getClientOriginalName();

            $mainPath = public_path('storage/facilities/');
            Image::read($imageFile)->save($mainPath . $imageName);

            $validated['image'] = 'facilities/' . $imageName;

            $thumbPath = public_path('storage/facilities/thumbnails/');
            $thumbName = 'thumbnail-' . $imageName;
            Image::read($imageFile)->resize(200, 200)->save($thumbPath . $thumbName);

            $validated['thumbnail_image'] = 'facilities/thumbnails/' . $thumbName;
        }

        Facility::create($validated);

        return to_route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $facility = Facility::findOrFail($id);
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, $id)
    {
        // Cari fasilitas berdasarkan ID
        $facility = Facility::findOrFail($id);

        // Cek apakah fasilitas yang akan diupdate adalah milik user yang sedang login
        if ($facility->user_id !== $request->user()->id) {
            return redirect()->route('admin.facilities.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengupdate fasilitas ini.');
        }

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'location'       => 'required|string|max:255',
            'type'           => 'required|string|max:100',
            'capacity'       => 'required|integer|min:1',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            // Menyimpan gambar utama
            $imageFile = $request->file('image');
            $imageName = date('Y-m-d_His') . '-' . $imageFile->getClientOriginalName();

            $mainPath = public_path('storage/facilities/');
            Image::read($imageFile)->save($mainPath . $imageName);
            $validated['image'] = 'facilities/' . $imageName;

            $thumbPath = public_path('storage/facilities/thumbnails/');
            $thumbName = 'thumbnail-' . $imageName;
            Image::read($imageFile)->resize(200, 200)->save($thumbPath . $thumbName);
            $validated['thumbnail_image'] = 'facilities/thumbnails/' . $thumbName;

            if ($facility->image && file_exists(public_path('storage/' . $facility->image))) {
                unlink(public_path('storage/' . $facility->image));
            }
            if ($facility->thumbnail_image && file_exists(public_path('storage/' . $facility->thumbnail_image))) {
                unlink(public_path('storage/' . $facility->thumbnail_image));
            }
        }

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }



    public function destroy(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        if ($facility->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk menghapus fasilitas ini.'], 403);
        }

        if ($facility->image && file_exists(public_path('storage/' . $facility->image))) {
            unlink(public_path('storage/' . $facility->image));
        }

        if ($facility->thumbnail_image && file_exists(public_path('storage/' . $facility->thumbnail_image))) {
            unlink(public_path('storage/' . $facility->thumbnail_image));
        }

        $facility->delete();

        return response()->json(['success' => 'Fasilitas berhasil dihapus.']);
    }
}
