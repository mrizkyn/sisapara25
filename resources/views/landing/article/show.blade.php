@extends('layouts.user.main')

@section('title', $article->title)

@push('css')
    <style>
        .article-detail-section {
            padding-top: 4rem;
            padding-bottom: 5rem;
            margin-top: 100px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #016974;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .article-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #212529;
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        .article-meta-details {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .article-meta-details span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-meta-details i {
            color: #016974;
        }


        .article-banner-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 2.5rem;
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #343a40;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5 {
            font-weight: 600;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: #212529;
        }

        .article-content a {
            color: #016974;
            text-decoration: underline;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .article-content blockquote {
            border-left: 4px solid #016974;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6c757d;
        }


        .article-sidebar {
            background-color: #016974;
            padding: 2rem;
            border-radius: 15px;
            position: static;
            margin-top: 169px;
        }

        .article-sidebar .list-group-item {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 0.75rem !important;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .article-sidebar .list-group-item:hover {
            background-color: #ffffff;
            transform: translateX(5px);
        }

        .article-sidebar .list-group-item a {
            text-decoration: none;
            color: #212529;
            font-weight: 600;
        }

        .article-sidebar .list-group-item small {
            font-weight: 400;
            display: block;
            color: #6c757d !important;
        }

        .sidebar-pagination .page-link {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-pagination .page-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar-pagination .page-item.active .page-link {
            background-color: #d5ff30;
            border-color: #d5ff30;
            color: #016974;
        }

        .sidebar-pagination .page-item.disabled .page-link {
            color: rgba(255, 255, 255, 0.4);
            background-color: transparent;
            border-color: rgba(255, 255, 255, 0.2);
        }
    </style>
@endpush

@section('main-content')
    <section class="article-detail-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <article>
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('informasi') }}">Informasi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 35) }}
                                </li>
                            </ol>
                        </nav>

                        <header class="article-header">
                            <h1>{{ $article->title }}</h1>
                            <div class="article-meta-details">
                                <span>
                                    <i class="fas fa-user"></i>
                                    <strong>Ditulis Oleh: {{ $article->user->name }}</strong>
                                </span>
                                <span>
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $article->created_at->translatedFormat('l, d F Y') }}
                                </span>
                                {{-- <span>
                                    <i class="fas fa-folder-open"></i>
                                    Kategori Artikel
                                </span> --}}
                            </div>
                        </header>

                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="article-banner-image"
                                alt="Gambar utama untuk {{ $article->title }}">
                        @endif

                        <div class="article-content">
                            {!! $article->content !!}
                        </div>
                    </article>
                </div>

                <div class="col-lg-4">
                    <aside class="article-sidebar">
                        <h5 class="text-white fw-bold mb-4">Artikel Lainnya</h5>
                        @if ($otherArticles->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach ($otherArticles as $other)
                                    <li class="list-group-item">
                                        <a href="{{ route('article.show', $other->slug) }}">
                                            {{ $other->title }}
                                            <small>oleh {{ $other->user->name }}</small>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-4 sidebar-pagination">
                                {{ $otherArticles->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <p class="text-white-50">Tidak ada artikel lainnya.</p>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
@endpush
