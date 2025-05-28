@extends('layouts.user.main')

@section('main-content')
    <div class="container mt-4" style="padding-top: 120px; padding-bottom: 20px">
        <h2 class="mb-4 fw-bold text-center"><i class='bx bxs-edit'></i>Edit profile</h2>

        <!-- Formulir Edit Admin -->
        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal; ">
                <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> Form Edit profile</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.profiles.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama admin"
                            required>
                        @error('name')
                            <div class="invalid-feedback">Nama wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email admin"
                            required>
                        @error('email')
                            <div class="invalid-feedback">Email harus valid dan belum terdaftar.</div>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <small class="text-muted">(Kosongkan jika tidak
                                diubah)</small></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Masukkan password baru">
                        @error('password')
                            <div class="invalid-feedback">Password minimal 8 karakter.</div>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-warning ms-auto">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
