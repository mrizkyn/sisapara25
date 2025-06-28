<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Facility;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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
                    'facilities.location',
                    'facilities.capacity',
                    'facilities.user_id',
                    'users.name as user_name'
                ])
                ->where('facilities.user_id', Auth::id())
                ->orderBy('facilities.created_at', 'desc')
                ->get()
                ->map(function ($facility, $index) {
                    $facility->no = $index + 1;
                    return $facility;
                });

            return DataTables::of($facilities)
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
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'location'       => 'required|string|max:255',
            'type'           => 'required|string|max:100',
            'capacity'       => 'required|integer|min:1',
            'account_name'   => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'bank_name'      => 'required|string|max:100',
            'banner'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tariffs'        => 'required|array|min:1',
            'tariffs.*.rental_type' => 'required|string|max:50',
            'tariffs.*.day_type' => 'required|in:Weekday,Weekend',
            'tariffs.*.time_type'  => 'required|in:Siang,Malam',
            'tariffs.*.price'    => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('banner')) {
            $validated['banner'] = $this->processImage($request->file('banner'));
        }

        $galleryImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $galleryImages[] = $this->processImage($img);
            }
            $validated['images'] = json_encode($galleryImages);
        }

        $facility = Facility::create($validated);

        foreach ($request->tariffs as $tariff) {
            $facility->tariffs()->create([
                'rental_type'  => $tariff['rental_type'],
                'day_type'  => $tariff['day_type'],
                'time_type'   => $tariff['time_type'],
                'price'     => $tariff['price'],
            ]);
        }
        return to_route('admin.facilities.index')->with('success', 'Fasilitas dan tarif berhasil ditambahkan.');
    }

    public function show($id)
    {
        $facility = Facility::with('tariffs')->findOrFail($id);

        if ($facility->user_id !== Auth::id()) {
            return redirect()->route('admin.facilities.index')
                ->with('error', 'Anda tidak memiliki izin untuk melihat fasilitas ini.');
        }

        $tariffGroups = $facility->tariffs->groupBy('rental_type');
        return view('admin.facilities.show', compact('facility', 'tariffGroups'));
    }

    public function edit($id)
    {
        $facility = Facility::findOrFail($id);
        return view('admin.facilities.edit', compact('facility'));
    }

    // public function update(Request $request, $id)
    // {
    //     $facility = Facility::findOrFail($id);

    //     if ($facility->user_id !== $request->user()->id) {
    //         return redirect()->route('admin.facilities.index')
    //             ->with('error', 'Anda tidak memiliki izin untuk mengupdate fasilitas ini.');
    //     }

    //     $validated = $request->validate([
    //         'name'           => 'required|string|max:255',
    //         'description'    => 'required|string',
    //         'location'       => 'required|string|max:255',
    //         'type'           => 'required|string|max:100',
    //         'capacity'       => 'required|integer|min:1',
    //         'account_name'   => 'required|string|max:255',
    //         'account_number' => 'required|string|max:50',
    //         'bank_name'      => 'required|string|max:100',
    //         'banner'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'images.*'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'tariffs'        => 'required|array|min:1',
    //         'tariffs.*.rental_type' => 'required|string|max:50',
    //         'tariffs.*.day_type'    => 'required|in:Weekday,Weekend',
    //         'tariffs.*.time_type'   => 'required|in:Siang,Malam',
    //         'tariffs.*.price'       => 'required|numeric|min:0',
    //     ]);

    //     $validated['user_id'] = $request->user()->id;

    //     if ($request->hasFile('banner')) {
    //         if ($facility->banner && Storage::disk('public')->exists($facility->banner)) {
    //             Storage::disk('public')->delete($facility->banner);
    //         }
    //         $validated['banner'] = $this->processImage($request->file('banner'));
    //     }

    //     if ($request->hasFile('images')) {
    //         if ($facility->images) {
    //             foreach (json_decode($facility->images) as $oldImage) {
    //                 if (Storage::disk('public')->exists($oldImage)) {
    //                     Storage::disk('public')->delete($oldImage);
    //                 }
    //             }
    //         }

    //         $galleryImages = [];
    //         foreach ($request->file('images') as $img) {
    //             $galleryImages[] = $this->processImage($img);
    //         }
    //         $validated['images'] = json_encode($galleryImages);
    //     }

    //     $facility->update($validated);

    //     $facility->tariffs()->delete();

    //     foreach ($request->tariffs as $tariff) {
    //         $facility->tariffs()->create([
    //             'rental_type' => $tariff['rental_type'],
    //             'day_type'    => $tariff['day_type'],
    //             'time_type'   => $tariff['time_type'],
    //             'price'       => $tariff['price'],
    //         ]);
    //     }
    //     return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    // }


    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

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
            'account_name'   => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'bank_name'      => 'required|string|max:100',
            'banner'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tariffs'        => 'required|array|min:1',
            'tariffs.*.id'           => 'nullable|integer|exists:facility_tariffs,id',
            'tariffs.*.rental_type' => 'required|string|max:50',
            'tariffs.*.day_type'    => 'required|in:Weekday,Weekend',
            'tariffs.*.time_type'   => 'required|in:Siang,Malam',
            'tariffs.*.price'       => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('banner')) {
            if ($facility->banner && Storage::disk('public')->exists($facility->banner)) {
                Storage::disk('public')->delete($facility->banner);
            }
            $validated['banner'] = $this->processImage($request->file('banner'));
        }

        if ($request->hasFile('images')) {
            if ($facility->images) {
                foreach (json_decode($facility->images) as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }

            $galleryImages = [];
            foreach ($request->file('images') as $img) {
                $galleryImages[] = $this->processImage($img);
            }
            $validated['images'] = json_encode($galleryImages);
        }

        $facility->update($validated);

        $tariffIds = [];

        foreach ($request->tariffs as $tariffData) {
            if (!empty($tariffData['id'])) {
                $tariff = $facility->tariffs()->where('id', $tariffData['id'])->first();
                if ($tariff) {
                    $tariff->update([
                        'rental_type' => $tariffData['rental_type'],
                        'day_type'    => $tariffData['day_type'],
                        'time_type'   => $tariffData['time_type'],
                        'price'       => $tariffData['price'],
                    ]);
                    $tariffIds[] = $tariff->id;
                }
            } else {
                $newTariff = $facility->tariffs()->create([
                    'rental_type' => $tariffData['rental_type'],
                    'day_type'    => $tariffData['day_type'],
                    'time_type'   => $tariffData['time_type'],
                    'price'       => $tariffData['price'],
                ]);
                $tariffIds[] = $newTariff->id;
            }
        }

        $facility->tariffs()->whereNotIn('id', $tariffIds)->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }


    public function destroy(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        if ($facility->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk menghapus fasilitas ini.'], 403);
        }

        $hasActiveReservation = $facility->reservations()
            ->whereIn('status', ['pending', 'verified'])
            ->exists();

        if ($hasActiveReservation) {
            return response()->json([
                'error' => 'Fasilitas ini tidak bisa dihapus karena masih memiliki reservasi yang belum selesai (pending atau verified).'
            ], 400);
        }

        if ($facility->banner && Storage::disk('public')->exists($facility->banner)) {
            Storage::disk('public')->delete($facility->banner);
        }

        if ($facility->images) {
            foreach (json_decode($facility->images) as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $equipments = Equipment::where('facility_id', $facility->id)->get();

        foreach ($equipments as $equipment) {
            if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
                Storage::disk('public')->delete($equipment->image);
            }

            $equipment->delete();
        }

        $facility->delete();

        return response()->json(['success' => 'Fasilitas dan peralatan terkait berhasil dihapus.']);
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
