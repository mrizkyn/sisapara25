@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold  text-center">Tambah Artikel Baru</h2>
        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal;">
                <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Form Tambah Artikel</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.articles.update', $article->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Artikel</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title', $article->title) }}" placeholder="Masukkan judul artikel"
                            required>
                        @error('title')
                            <div class="invalid-feedback">Judul artikel wajib diisi.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Deskripsi Artikel</label>
                        <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}">
                        <trix-editor input="content" class="@error('content') is-invalid @enderror"></trix-editor>
                        @error('content')
                            <div class="invalid-feedback">Deskripsi artikel wajib diisi.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Artikel</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">Gambar artikel wajib diupload dan harus berformat gambar.</div>
                        @enderror
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-success ms-auto">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
