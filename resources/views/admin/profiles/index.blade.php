@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-center">My Profile</h2>
        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal;">
                <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> My Profile</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <div class="form-control"> {{ $user->name }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="form-control">{{ $user->email }}</div>
                </div>
                <div class="d-flex">
                    <a href="{{ route('admin.profiles.edit', $user->id) }}" class="btn btn-warning ms-auto">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
