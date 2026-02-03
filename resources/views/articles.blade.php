@extends('layouts.app')

@section('title', 'Archives')

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">


                <div class="col-md-3">


                    <div class="card-c mb-3">
                        <img class="img-fluid"
                                src="{{ url('assets/Journals/img/' . $journal->photo) }}" alt="Image"
                                style=" width: 100%; object-fit: contain;"
                                >
                    </div>

                    @include('partials.quicklinks2')


                </div>

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    
                    <div class="card-c">

                        <div class="card-header">
                            <div class="h-box">
                                <div class="h-box-text p-2">
                                    {{ $volume->name }} - {{ $issue->name }} ({{ $issue->month }} {{ $volume->year }}) | {{ $journal->j_name }}
                                </div>
                            </div>
                        </div>
                        <br>

                        {{-- <h4>{{ $volume->name }} - {{ $issue->name }} ({{ $issue->month }} {{ $volume->year }})</h4> --}}
                        <br>

                        @include('partials.articles')

                    </div>



                </div>

        


            </div>
        </div>
    </div>





@endsection
