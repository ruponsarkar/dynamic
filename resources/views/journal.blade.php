@extends('layouts.app')

@section('title', $article->name )

@section('citation')
    <meta name="citation_title" content="{{ $article->name }}">
    <meta name="citation_author" content="{{ $article->aname }}">
    <meta name="citation_publication_date" content="{{ $article->published_date }}">
    <meta name="citation_journal_title" content="{{ $journal->j_name }}">
    <meta name="citation_volume" content="{{ $volume->name ?? '' }}">
    <meta name="citation_issue" content="{{ $issue->name ?? '' }}">
    <meta name="citation_doi" content="{{ $article->doi }}">
@endsection

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    <div class="card cus-padding">

                        <h4>{{ $article->name }}</h4>
                        <br>

                        <div class="pb-2">
                            <div>
                                <b>Abstractu</b>
                            </div>
                            {!! $article->abstract !!}
                        </div>
                        <div class="pb-2">
                            <div>
                                <b>Keywords:</b>{{ $article->keywords }}
                            </div>
                        </div>
                        <div class="pb-2">
                            <div>
                                <b>Author(s):</b>{{ $article->aname }}
                            </div>
                        </div>

                        @if ($article->email)
                            <div class="pb-2">
                                <div>
                                    <b>Email:</b>{{ $article->email }}
                                </div>
                            </div>
                        @endif

                        @if ($article->doi)
                            <div class="pb-2">
                                <div>
                                    <b>DOI:</b>{{ $article->doi }}
                                </div>
                            </div>
                        @endif
                        @if ($article->orcid_id)
                            <div class="pb-2">
                                <div>
                                    <b>Orcid-id:</b>{{ $article->orcid_id }}
                                </div>
                            </div>
                        @endif



                        <div>
                            <a class="btn btn-outline-primary btn-sm" href="/assets/articles/{{ $article->file }}">Download PDF </a>
                        </div>

                    </div>



                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="col-md-3">



                    @include('partials.right')


                </div>



            </div>
        </div>
    </div>





@endsection
