@extends('layouts.app')

@section('title', $article->name)

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

                    @include('partials.quicklinks2')


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
                                    <b>Abstract</b>
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
                                        <b>DOI:</b> <a href="{{ $article->doi }}" target="_blank">{{ $article->doi }}</a>
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

                            <div class="pt-3">
                                <a href="/assets/articles/{{ $article->file }}" class="btn btn-primary">Download PDF</a>
                            </div>
                        </div>

                    </div>



                </div>

                <!-- RIGHT SIDEBAR -->




            </div>
        </div>
    </div>





@endsection
