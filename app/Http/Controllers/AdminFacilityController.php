<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AdminFacilityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userId = $request->user()->id;
            $facilities = Facility::join('users', 'facilities.user_id', '=', 'users.id')
                ->select([
                    'facilities.id',
                    'facilities.name',
                    'facilities.location',
                    'facilities.capacity',
                    'facilities.user_id',
                    'users.name as user_name'
                ])
                ->where('facilities.user_id', $userId)
                ->orderBy('facilities.created_at', 'desc')
                ->get()
                ->map(function ($facility, $index) {
                    $facility->no = $index + 1;
                    return $facility;
                });

            return DataTables::of($facilities)
                ->editColumn('user_name', function ($facility) {
                    return $facility->user_name ?? '-';
                })
                ->addColumn('action', function ($facility) {
                    return '<a href="' . route('admin.facilities.edit', $facility->id) . '" class="btn btn-primary btn-sm">Edit</a>
            <a href="' . route('admin.facilities.show', $facility->id) . '" class="btn btn-info btn-sm">Detail</a>
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
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $this->processImage($request->file('image'));
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
        $facility = Facility::findOrFail($id);

        if ($facility->user_id !== $request->user()->id) {
            return redirect()->route('admin.facilities.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengupdate fasilitas ini.');
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'type'        => 'required|string|max:100',
            'capacity'    => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            if ($facility->image && Storage::disk('public')->exists($facility->image)) {
                Storage::disk('public')->delete($facility->image);
            }

            $validated['image'] = $this->processImage($request->file('image'));
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

        if ($facility->image && Storage::disk('public')->exists($facility->image)) {
            Storage::disk('public')->delete($facility->image);
        }

        $facility->delete();

        return response()->json(['success' => 'Fasilitas berhasil dihapus.']);
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

        $filename = 'facilities/' . now()->format('Ymd_His') . '_' . uniqid() . '.jpg';
        Storage::disk('public')->put($filename, $encodedImage);

        return $filename;
    }
}