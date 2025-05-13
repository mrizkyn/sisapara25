@extends('layouts.user.main')

@section('title', $article->title)

@section('main-content')
    <style>
        .card-img-top {
            max-height: 400px;
            object-fit: contain;
            border-bottom: 2px solid #f1f1f1;
        }

        p.small {
            color: #f1f1f1 !important
        }

        .list-group-item {
            border-radius: 8px;
            padding: 15px;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #02475e;
            color: #fff;
        }
    </style>


    <section class="py-5" style="margin-top :150px">
        <div class="container">
            <div class="row text-start">
                <!-- Kiri: Artikel Utama -->
                <div class="col-md-8 mb-4">
                    <div>
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="Gambar Artikel">
                        @endif
                        <div>
                            <h3 class=" text-primary">{{ $article->title }}</h3>
                            <p class="text-muted">Ditulis oleh: {{ $article->user->name }}</p>
                            <p class="card-text">{!! $article->content !!}</p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Artikel Lainnya -->
                <div class="col-md-4 p-4 rounded-1" style="background-color: #016974">
                    <h5 class="text-white mb-3">Artikel Lainnya</h5>
                    <ul class="list-group">
                        @foreach ($otherArticles as $other)
                            <li class="list-group-item mb-2 border-0">
                                <a href="{{ route('article.show', $other->id) }}" class="text-decoration-none text-dark">
                                    {{ $other->title }} <br> <small class="text-muted">oleh {{ $other->user->name }}</small>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3 text-white">
                        {{ $otherArticles->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
