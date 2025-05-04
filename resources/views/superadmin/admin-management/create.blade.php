@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold  text-center">Tambah Admin Baru</h2>

        <!-- Formulir Create Admin -->
        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal; ">
                <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i> Form Tambah Admin</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.admin-management.store') }}" method="POST">
                    @csrf

                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" placeholder="Masukkan nama admin" required>
                        @error('name')
                            <div class="invalid-feedback">Nama wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" placeholder="Masukkan email admin" required>
                        @error('email')
                            <div class="invalid-feedback">Email harus valid dan belum terdaftar.</div>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Masukkan password admin" required>
                        @error('password')
                            <div class="invalid-feedback">Password minimal 8 karakter.</div>
                        @enderror
                    </div>

                    <!-- Pilihan Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                            required>
                            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">Role wajib dipilih.</div>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-success ms-auto">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
