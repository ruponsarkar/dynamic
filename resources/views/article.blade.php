@extends('layouts.app')

@php
    $scholarly = \App\Support\ScholarlyMetadata::article($article, $journal, $volume, $issue, $article->publicationAuthors);
@endphp
@section('title', $article->name)
@section('description', \Illuminate\Support\Str::limit(\App\Support\ScholarlyMetadata::text($article->abstract), 200))
@section('meta_type', 'article')
@section('meta_image', url('assets/journals/img/' . $journal->photo))
@section('meta_tags')
    @include('partials.scholarly-metadata')
@endsection

@section('content')
    <main class="publisher-interior-page publisher-article-page">
        <div class="container py-4 py-lg-5">
            <div class="row g-4 align-items-start">
                <aside class="col-lg-3 order-2">
                    <div class="publisher-interior-cover">
                        <img src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="{{ $journal->j_name }} cover">
                        <div class="publisher-article-journal-name">{{ $journal->j_name }}</div>
                    </div>
                    @include('partials.quicklinks1')
                </aside>

                <article class="col-lg-9 order-1">
                    <header class="publisher-page-hero publisher-article-hero">
                        <p class="publisher-eyebrow">Research article <span aria-hidden="true">·</span> {{ $journal->j_name }}</p>
                        <h1>{{ $article->name }}</h1>
                        <div class="publisher-article-authors">
                            <span class="publisher-article-meta-label">Author(s)</span>
                            <div>{!! \App\Support\ArticleAuthors::display($article->aname) !!}</div>
                            @if (trim((string) $article->designation) !== '')
                                <div class="publisher-article-affiliations">{!! \App\Support\ArticleAuthors::display($article->designation) !!}</div>
                            @endif
                        </div>
                        <div class="publisher-article-dates">
                            @foreach (['received' => 'Received', 'accepted' => 'Accepted', 'published_date' => 'Published'] as $field => $label)
                                @if ($displayDate = \App\Support\ScholarlyMetadata::date($article->$field))
                                    <span><small>{{ $label }}</small><strong>{{ $displayDate }}</strong></span>
                                @endif
                            @endforeach
                        </div>
                        @if ($article->doi)
                            <a class="publisher-article-doi" href="{{ $article->doi }}" target="_blank" rel="noopener noreferrer">DOI <span>{{ $article->doi }}</span> ↗</a>
                        @endif
                    </header>

                    <section class="publisher-article-content-card">
                        <section class="publisher-article-content-block">
                            <p class="publisher-eyebrow">Article overview</p>
                            <h2>Abstract</h2>
                            <div class="publisher-rich-content">{!! $article->abstract !!}</div>
                        </section>

                        @if ($article->keywords)
                            <section class="publisher-article-keywords">
                                <h2>Keywords</h2>
                                <p>{{ $article->keywords }}</p>
                            </section>
                        @endif

                        @if ($article->email || $article->orcid_id)
                            <section class="publisher-article-contact-row">
                                @if ($article->email)
                                    <div><small>Correspondence</small><a href="mailto:{{ $article->email }}">{{ $article->email }}</a></div>
                                @endif
                                @if ($article->orcid_id)
                                    <div><small>ORCID iD</small><span>{{ $article->orcid_id }}</span></div>
                                @endif
                            </section>
                        @endif

                        <div class="publisher-article-download-row">
                            <span><strong>Read the full paper</strong><small>Download the published article as a PDF.</small></span>
                            <a class="publisher-button publisher-article-download" href="{{ url('assets/articles/' . $article->file) }}" target="_blank" rel="noopener noreferrer">Download PDF <span aria-hidden="true">↗</span></a>
                        </div>
                    </section>
                </article>
            </div>
        </div>
    </main>
@endsection
