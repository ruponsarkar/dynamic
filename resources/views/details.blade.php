@extends('layouts.app')

@section('title', $journal->j_name)

@section('content')
    <style>
        .jd-page {
            --jd-primary: #0e4d5c;
            --jd-accent: #d97706;
            --jd-ink: #102a43;
            --jd-muted: #5f6c7b;
            --jd-surface: #ffffff;
            --jd-bg: linear-gradient(180deg, #e9f1f4 0%, #f4f7f8 36%, #f3f3f3 100%);
            background: var(--jd-bg);
            padding: 1.5rem 0 2.75rem;
        }

        .jd-sidebar,
        .jd-main-card,
        .jd-section {
            background: var(--jd-surface);
            border-radius: 14px;
            box-shadow: 0 14px 30px -24px rgba(16, 42, 67, 0.65);
            border: 1px solid rgba(14, 77, 92, 0.08);
        }

        .jd-cover-wrap {
            background: radial-gradient(circle at 14% 15%, #eef7fa 0, #d8e9ef 45%, #c2d7e0 100%);
            padding: 1rem;
            border-radius: 12px;
        }

        .jd-cover {
            width: 100%;
            max-height: 420px;
            object-fit: contain;
            border-radius: 8px;
            background: #fff;
        }

        .jd-main-card {
            overflow: hidden;
        }

        .jd-hero {
            padding: 1.4rem 1.5rem;
            background: linear-gradient(120deg, #0e4d5c 0%, #136c73 55%, #1a7f84 100%);
            color: #fff;
            position: relative;
        }

        .jd-hero::after {
            content: "";
            position: absolute;
            right: -42px;
            bottom: -55px;
            width: 180px;
            height: 180px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            transform: rotate(15deg);
        }

        .jd-badge {
            display: inline-block;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            font-weight: 700;
            text-transform: uppercase;
            padding: 0.28rem 0.6rem;
            border-radius: 999px;
            margin-bottom: 0.75rem;
            background: rgba(255, 255, 255, 0.18);
        }

        .jd-title {
            font-size: clamp(1.25rem, 2.5vw, 2rem);
            line-height: 1.3;
            margin: 0;
            font-weight: 700;
            max-width: 92%;
        }

        .jd-sub {
            margin: 0.75rem 0 0;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .jd-body {
            padding: 1.35rem 1.35rem 1.45rem;
        }

        .jd-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.8rem;
            margin: 0;
        }

        .jd-meta-item {
            list-style: none;
            background: #f7fafb;
            border: 1px solid #e5edf1;
            border-radius: 10px;
            padding: 0.75rem 0.85rem;
            min-height: 88px;
        }

        .jd-label {
            display: block;
            font-size: 0.74rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--jd-muted);
            margin-bottom: 0.3rem;
            font-weight: 700;
        }

        .jd-value {
            font-size: 0.98rem;
            color: var(--jd-ink);
            font-weight: 600;
            line-height: 1.45;
            word-break: break-word;
        }

        .jd-section {
            margin-top: 1rem;
            overflow: hidden;
        }

        .jd-section-head {
            font-size: 1.04rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(90deg, #0e4d5c 0, #136f79 100%);
            padding: 0.78rem 1rem;
            margin: 0;
        }

        .jd-section-body {
            padding: 1.1rem 1rem;
            color: #1f2933;
            line-height: 1.7;
        }

        .jd-articles {
            background: linear-gradient(140deg, #edf5f7 0%, #f8fbfc 100%);
            border: 1px solid #dbe9ef;
            border-radius: 12px;
            padding: 0.55rem;
        }

        .jd-articles .card-c {
            border: 1px solid #e4edf1;
            box-shadow: 0 10px 18px -20px rgba(0, 0, 0, 0.85);
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .jd-articles .card-c:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 20px -20px rgba(16, 42, 67, 0.9);
        }

        @media (max-width: 991px) {
            .jd-meta {
                grid-template-columns: 1fr;
            }

            .jd-page {
                padding-top: 1rem;
            }
        }
    </style>

    @php
        $meta = [
            'Abbreviated Key Title' => $journal->abbr_title,
            'ISSN' => $journal->issn,
            'Frequency' => $journal->frequency,
            'Subject' => $journal->subject,
            'Language' => $journal->language,
            'Format' => $journal->format,
            'Starting Year' => $journal->starting_year ?? $journal->start_year ?? 'N/A',
            'Publisher' => $journal->publisher,
            'Origin' => $journal->country_of_origin,
        ];
    @endphp

    <div class="jd-page">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <aside class="jd-sidebar p-3">
                        <div class="jd-cover-wrap mb-3">
                            <img class="jd-cover" src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="{{ $journal->j_name }} cover image">
                        </div>

                        @include('partials.quicklinks1')
                    </aside>
                </div>

                <div class="col-lg-9">
                    <section class="jd-main-card">
                        <header class="jd-hero">
                            <span class="jd-badge">Journal Profile</span>
                            <h1 class="jd-title">{{ $journal->j_name }}</h1>
                            <p class="jd-sub">Explore key publication details, scope, and the latest published articles.</p>
                        </header>

                        <div class="jd-body">
                            <ul class="jd-meta ps-0">
                                @foreach ($meta as $label => $value)
                                    <li class="jd-meta-item">
                                        <span class="jd-label">{{ $label }}</span>
                                        <span class="jd-value">{{ $value ?: 'N/A' }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <section class="jd-section">
                                <h2 class="jd-section-head">Aim and Scope</h2>
                                <div class="jd-section-body">
                                    {!! $journal->aim_and_scope !!}
                                </div>
                            </section>
                        </div>
                    </section>

                    <section class="jd-section mt-3">
                        <h2 class="jd-section-head">Recent Articles</h2>
                        <div class="jd-section-body">
                            <div class="jd-articles">
                                @include('partials.articles')
                            </div>
                        </div>
                    </section>

                    <section class="jd-section mt-3">
                        <h2 class="jd-section-head">Certificates</h2>
                        <div class="jd-section-body">
                            <div class="row g-3">
                                @forelse ($certificates as $certificate)
                                    <div class="col-md-4">
                                        <div class="jd-articles h-100">
                                            <img class="img-fluid rounded"
                                                src="{{ url('assets/certificates/img/' . $certificate->img) }}"
                                                alt="{{ $certificate->title ?: 'Certificate' }}"
                                                style="width: 100%; object-fit: contain;">
                                            @if ($certificate->title)
                                                <div class="text-center mt-2">
                                                    <small><b>{{ $certificate->title }}</b></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="mb-0">No certificates available for this journal.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
