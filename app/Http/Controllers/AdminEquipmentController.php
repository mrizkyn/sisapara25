<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Facility;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdminEquipmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $equipments = Equipment::join('facilities', 'equipment.facility_id', '=', 'facilities.id')
                ->select([
                    'equipment.id',
                    'equipment.name',
                    'equipment.brand',
                    'equipment.quantity',
                    'equipment.image',
                    'facilities.name as facility_name'
                ])
                ->where('facilities.user_id', Auth::id())
                ->orderBy('equipment.created_at', 'desc')
                ->get()
                ->map(function ($equipment, $index) {
                    $equipment->no = $index + 1;
                    return $equipment;
                });

            return DataTables::of($equipments)
                ->addColumn('image', function ($equipment) {
                    if ($equipment->image) {
                        return '<img src="' . asset('storage/' . $equipment->image) . '" width="50" height="50">';
                    }
                    return '-';
                })
                ->addColumn('action', function ($equipment) {
                    return '
                    <a href="' . route('admin.equipments.edit', $equipment->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="' . $equipment->id . '">Delete</button>
                ';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.equipments.index');
    }

    public function create()
    {
        $facilities = Facility::where('user_id', Auth::id())->get();
        return view('admin.equipments.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'brand'      => 'required|string|max:255',
            'quantity'   => 'required|integer|min:1',
            'facility_id' => 'required|exists:facilities,id',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->processImage($request->file('image'));
        }

        Equipment::create($validated);

        return to_route('admin.equipments.index')
            ->with('success', 'Peralatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        $facilities = Facility::where('user_id', Auth::id())->get();
        return view('admin.equipments.edit', compact('equipment', 'facilities'));
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::findOrFail($id);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'brand'      => 'required|string|max:255',
            'quantity'   => 'required|integer|min:1',
            'facility_id' => 'required|exists:facilities,id',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
                Storage::disk('public')->delete($equipment->image);
            }
            $validated['image'] = $this->processImage($request->file('image'));
        }

        $equipment->update($validated);

        return redirect()->route('admin.equipments.index')
            ->with('success', 'Peralatan berhasil diperbarui.');
    }
    public function destroy(Request $request, $id)
    {
        $Equipment = Equipment::findOrFail($id);

        if ($Equipment->image && Storage::disk('public')->exists($Equipment->image)) {
            Storage::disk('public')->delete($Equipment->image);
        }

        $Equipment->delete();

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

        $filename = 'equipments/' . now()->format('Ymd_His') . '_' . uniqid() . '.jpg';
        Storage::disk('public')->put($filename, $encodedImage);

        return $filename;
    }
}
