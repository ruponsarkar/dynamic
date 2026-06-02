@extends('layouts.app')

@section('title', 'Search Articles')

@section('content')
    <div class="container py-4">
        <div class="card-c p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                <div>
                    <h1 class="h4 mb-1" style="color: #1976d2; font-weight: bold;">Search Articles</h1>
                    @if ($query !== '')
                        <div class="text-muted small">
                            Showing results for <b>{{ $query }}</b>
                        </div>
                    @endif
                </div>

                <form class="d-flex" action="{{ route('article.search') }}" method="GET" role="search">
                    <input class="form-control" type="search" name="q" value="{{ $query }}"
                        placeholder="Search articles" aria-label="Search articles">
                    <button class="btn btn-primary ms-2" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            @if ($query === '')
                <div class="alert alert-info mb-0">Enter a keyword, author, DOI, or article title to search.</div>
            @elseif ($articles->count())
                @include('partials.articles')

                <div class="mt-3">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="alert alert-warning mb-0">No articles found for <b>{{ $query }}</b>.</div>
            @endif
        </div>
    </div>
@endsection
