@extends('layouts.app')

@section('title', 'Editorial Board | ' . $journal->j_name)

@section('content')
    <main class="publisher-interior-page publisher-editorial-page">
        <div class="container py-4 py-lg-5">
            @include('partials.journal-tabs', ['activeJournalTab' => 'editorial'])

            <div class="row g-4 align-items-start">
                <aside class="col-lg-3 order-2">
                    <div class="publisher-interior-cover">
                        <img src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="{{ $journal->j_name }} cover">
                    </div>
                    @include('partials.quicklinks1')
                </aside>

                <section class="col-lg-9 order-1">
                    <header class="publisher-page-hero">
                        <p class="publisher-eyebrow">People behind the journal</p>
                        <h1>Editorial board</h1>
                        <p>{{ $journal->j_name }} brings together experienced scholars to guide its editorial standards and research direction.</p>
                    </header>

                    @if (count($editors))
                        <div class="publisher-editor-grid">
                            @foreach ($editors as $editor)
                                <article class="publisher-editor-card">
                                    <div class="publisher-editor-card-top">
                                        <span class="publisher-editor-avatar">
                                            @if (!empty($editor->image))
                                                <img src="{{ url('/assets/img/editor-img/' . $editor->image) }}" alt="{{ $editor->name }}">
                                            @else
                                                <span aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($editor->name, 0, 1)) }}</span>
                                            @endif
                                        </span>
                                        <span class="publisher-editor-role">{{ $editor->type }} editor</span>
                                    </div>
                                    <h2>{{ $editor->name }}</h2>
                                    @if ($editor->university)
                                        <p class="publisher-editor-affiliation">{{ $editor->university }}</p>
                                    @endif
                                    @if ($editor->details)
                                        <p class="publisher-editor-bio">{{ $editor->details }}</p>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="publisher-editor-empty">
                            <span aria-hidden="true">✦</span>
                            <h2>Editorial appointments are being updated</h2>
                            <p>Please check back soon for the latest information about the {{ $journal->j_name }} editorial board.</p>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </main>
@endsection
