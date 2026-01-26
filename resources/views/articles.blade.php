@extends('layouts.app')

@section('title', 'Archives')

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    <div class="card cus-padding">

                        <h4>{{ $volume->name }} - {{ $issue->name }} ({{ $issue->month }} {{ $volume->year }})</h4>
                        <br>

                        <div>
                            @foreach ($articles as $a)
                                <div class="border border-dark rounded p-2 m-2">
                                    <h5>
                                        <a href="#">{{ $a->name }}</a>
                                    </h5>

                                    <div>
                                        Author(s): {{ $a->aname }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $volume->name }} - {{ $issue->name }}
                                    </div>

                                    @if ($a->page)
                                        <div class="text-muted">
                                            Page: {{ $a->page }}
                                        </div>
                                    @endif

                                    @if ($a->doi)
                                        <div class="text-muted">
                                            DOI : <a href="{{ $a->doi }}">{{ $a->doi }}</a>
                                        </div>
                                    @endif

                                    <div>
                                        <a href="/journal/{{ $a->slug }}">Read More »</a>

                                    </div>

                                </div>
                            @endforeach
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
