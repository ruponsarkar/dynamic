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



                            <h1 class="h4">{{ $article->name }}</h1>
                            <br>

                            <div class="pb-2">
                                <div>
                                    <b>Author(s):</b>{!! \App\Support\ArticleAuthors::display($article->aname) !!}
                                    @if (trim((string) $article->designation) !== '')
                                        <div class="mt-2 text-muted article-affiliations">{!! \App\Support\ArticleAuthors::display($article->designation) !!}</div>
                                    @endif
                                </div>
                            </div>


                            <div class="pb-2">
                                <div>
                                    @foreach (['received' => 'Received', 'accepted' => 'Accepted', 'published_date' => 'Published'] as $field => $label)
                                        @if ($displayDate = \App\Support\ScholarlyMetadata::date($article->$field))
                                            <span class="me-2"><b>{{ $label }}:</b> {{ $displayDate }}</span>
                                        @endif
                                    @endforeach
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
