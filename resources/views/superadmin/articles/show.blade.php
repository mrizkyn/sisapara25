@extends('layouts.panel.main')

@section('main')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="row g-0">
                @if ($article->image)
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded-start"
                            alt="Gambar Artikel" style="object-fit: contain; height: 100%;">
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">{{ $article->title }}</h3>
                        <p class="text-muted">Oleh: {{ $article->user->name ?? 'Tidak diketahui' }} |
                            {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</p>
                        <hr>
                        <div class="card-text">
                            {!! $article->content !!}
                        </div>
                        <a href="{{ route('superadmin.articles.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
