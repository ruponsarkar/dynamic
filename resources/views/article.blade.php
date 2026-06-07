@extends('layouts.app')

@php
    $journal = \Illuminate\Support\Facades\DB::table('journals')->where('j_id', $article->j_id)->first();
    $abstractText = preg_replace('/\s+/', ' ', trim(strip_tags($article->abstract ?? '')));
    $metaDescription =
        $abstractText !== ''
            ? (string) $abstractText
            : 'Read the full research article published by Research Journal of Medical Science.';
    $citationAuthors = preg_split('/\s*(?:,|;|\band\b)\s*/i', $article->aname ?? '', -1, PREG_SPLIT_NO_EMPTY) ?: [];
    $publicationDate = !empty($article->published_date)
        ? \Carbon\Carbon::parse($article->published_date)->format('Y/m/d')
        : null;
    $displayPublicationDate = !empty($article->published_date)
        ? \Carbon\Carbon::parse($article->published_date)->format('F j, Y')
        : null;
    $pdfUrl = !empty($article->file) ? url('assets/articles/' . $article->file) : null;
    $articleUrl = url()->current();
    $journalTitle = $journal->name ?? 'Research Journal of Medical Science';
    $metaImage = !empty($journal?->photo)
        ? url('assets/journals/img/' . $journal->photo)
        : asset('fav/android-icon-192x192.png');
@endphp

@section('title', $article->name)
@section('description', $metaDescription)
@section('meta_type', 'article')
@section('meta_image', $metaImage)
@section('meta_tags')
    <meta property="article:published_time"
        content="{{ !empty($article->published_date) ? \Carbon\Carbon::parse($article->published_date)->toIso8601String() : '' }}">
    @if (!empty($article->received))
        <meta property="article:modified_time" content="{{ \Carbon\Carbon::parse($article->received)->toIso8601String() }}">
    @endif
    @if (!empty($article->doi))
        <meta property="article:tag" content="{{ $article->doi }}">
    @endif
    @if (!empty($article->keywords))
        <meta name="keywords" content="{{ $article->keywords }}">
        <meta property="article:tag" content="{{ $article->keywords }}">
    @endif
    <meta name="citation_title" content="{{ $article->name }}">
    <meta name="citation_journal_title" content="{{ $journalTitle }}">
    @foreach ($citationAuthors as $citationAuthor)
        <meta name="citation_author" content="{{ trim($citationAuthor) }}">
    @endforeach
    @if ($publicationDate)
        <meta name="citation_publication_date" content="{{ $publicationDate }}">
        <meta name="citation_online_date" content="{{ $publicationDate }}">
    @endif
    @if (!empty($article->doi))
        <meta name="citation_doi" content="{{ preg_replace('/^https?:\/\/(?:dx\.)?doi\.org\//i', '', $article->doi) }}">
    @endif
    @if (!empty($article->keywords))
        <meta name="citation_keywords" content="{{ $article->keywords }}">
    @endif
    <meta name="citation_abstract_html_url" content="{{ $articleUrl }}">
    @if ($pdfUrl)
        <meta name="citation_pdf_url" content="{{ $pdfUrl }}">
    @endif
    @if (!empty($article->page))
        <meta name="citation_firstpage" content="{{ preg_replace('/^([0-9]+).*$/', '$1', $article->page) }}">
        <meta name="citation_lastpage" content="{{ preg_replace('/^.*?([0-9]+)$/', '$1', $article->page) }}">
    @endif
    @if ($displayPublicationDate)
        <meta name="dc.date" content="{{ $displayPublicationDate }}">
    @endif
    <meta name="dc.title" content="{{ $article->name }}">
    <meta name="dc.description" content="{{ $metaDescription }}">
    <meta name="dc.publisher" content="IRGS Publisher">
    <meta name="dc.source" content="{{ $journalTitle }}">
    <meta name="dc.identifier" content="{{ $articleUrl }}">
    @if (!empty($article->doi))
        <meta name="dc.identifier.doi"
            content="{{ preg_replace('/^https?:\/\/(?:dx\.)?doi\.org\//i', '', $article->doi) }}">
    @endif
    @foreach ($citationAuthors as $citationAuthor)
        <meta name="dc.creator" content="{{ trim($citationAuthor) }}">
    @endforeach
@endsection

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

                <div class="col-md-3">

                    <div class="card-c mb-3">
                        <img class="img-fluid" src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="Image"
                            style=" width: 100%; object-fit: contain;">
                    </div>

                    @include('partials.quicklinks1')


                </div>

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    <div class="card-c ">

                        <div class="card-header">
                            <div class="h-box">
                                <div class="h-box-text p-2">
                                    {{ $article->name }}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="p-4">



                            <h4>{{ $article->name }}</h4>
                            <br>

                            <div class="pb-2">
                                <div>
                                    <b>Author(s):</b>{{ $article->aname }}
                                </div>
                            </div>


                            <div class="pb-2">
                                <div>
                                    <b>Received:</b> {{ \Carbon\Carbon::parse($article->received)->format('F j, Y') }}
                                    |
                                    <b>Accepted:</b> {{ \Carbon\Carbon::parse($article->accepted)->format('F j, Y') }}
                                    |
                                    <b>Published:</b>
                                    {{ \Carbon\Carbon::parse($article->published_date)->format('F j, Y') }}
                                </div>
                            </div>

                            <br>

                            <div class="pb-2">
                                <div>
                                    <b>Abstract</b>
                                </div>
                                {!! $article->abstract !!}
                            </div>

                            <br>

                            <div class="pb-2">
                                <div>
                                    <b>Keywords: </b> {{ $article->keywords }}
                                </div>
                            </div>
                            <br>

                            @if ($article->email)
                                <div class="pb-2">
                                    <div>
                                        <b>Email:</b>{{ $article->email }}
                                    </div>
                                </div>
                            @endif
                            <br>
                            @if ($article->doi)
                                <div class="pb-2">
                                    <div>
                                        <b>DOI:</b> <a class="text-dark" href="{{ $article->doi }}"
                                            target="_blank">{{ $article->doi }}</a>
                                    </div>
                                </div>
                            @endif
                            <br>
                            @if ($article->orcid_id)
                                <div class="pb-2">
                                    <div>
                                        <b>Orcid-id:</b>{{ $article->orcid_id }}
                                    </div>
                                </div>
                            @endif

                            <br>
                            <div class="pb-2">
                                <div>
                                    <a class="btn btn-primary btn-sm" href="{{ url('assets/articles/' . $article->file) }}"
                                        target="_blank">Download PDF</a>
                                </div>

                            </div>

                        </div>



                    </div>

                    <!-- RIGHT SIDEBAR -->




                </div>
            </div>
        </div>





    @endsection
