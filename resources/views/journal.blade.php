@extends('layouts.app')

@section('title', $article->name )

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
