<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SuperAdminUserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'role', 'created_at']);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('superadmin.admin-management.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('superadmin.admin-management.index');
    }

    public function create()
    {
        return view('superadmin.admin-management.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:superadmin,admin,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('superadmin.admin-management.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.admin-management.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:superadmin,admin,user',
        ]);

        $user = User::findOrFail($id);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('superadmin.admin-management.index')->with('success', 'Data admin berhasil diperbarui.');
    }
}
