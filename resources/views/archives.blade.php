@extends('layouts.app')

@section('title', 'Journal archive | ' . $journal->j_name)

@section('content')
    <main class="publisher-interior-page publisher-archive-page">
        <div class="container py-4 py-lg-5">
            @include('partials.journal-tabs', ['activeJournalTab' => 'archive'])

            <div class="row g-4 align-items-start">
                <aside class="col-lg-3 order-2">
                    <div class="publisher-interior-cover">
                        <img src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="{{ $journal->j_name }} cover">
                    </div>
                    @include('partials.quicklinks1')
                </aside>

                <section class="col-lg-9 order-1">
                    <header class="publisher-page-hero publisher-page-hero-compact">
                        <p class="publisher-eyebrow">Explore past research</p>
                        <h1>Journal archive</h1>
                        <p>Browse published issues of <strong>{{ $journal->j_name }}</strong> by volume and year.</p>
                    </header>

                    @forelse ($data as $year => $issues)
                        <section class="publisher-archive-volume">
                            <header class="publisher-archive-volume-head">
                                <span class="publisher-archive-year">{{ $issues[0]->year }}</span>
                                <h2>{{ $issues[0]->volume_name }}</h2>
                                <span class="publisher-archive-count">{{ count($issues) }} {{ \Illuminate\Support\Str::plural('issue', count($issues)) }}</span>
                            </header>
                            <div class="publisher-archive-issues">
                                @foreach ($issues as $issue)
                                    <a class="publisher-archive-issue" href="{{ url('archives/' . $journal->slug . '/' . $issue->volume_slug . '/' . $issue->slug) }}?i={{ $issue->id }}&v={{ $issue->v_id }}">
                                        <span class="publisher-archive-issue-icon" aria-hidden="true">▤</span>
                                        <span><small>Volume {{ $issue->volume_name }}</small><strong>{{ $issue->name }}</strong></span>
                                        <span class="publisher-archive-arrow" aria-hidden="true">↗</span>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @empty
                        <div class="publisher-editor-empty">
                            <span aria-hidden="true">▤</span>
                            <h2>No archived issues yet</h2>
                            <p>Published issues for {{ $journal->j_name }} will appear here.</p>
                        </div>
                    @endforelse
                </section>
            </div>
        </div>
    </main>
@endsection
