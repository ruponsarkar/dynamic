@extends('layouts.app')

@section('title', 'All Journals')

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

              

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    <div class="card-c">

                        <div class="card-header">
                            <div class="h-box">
                                <div class="h-box-text p-2">
                                    Journals
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row p-4">

                            @foreach ($journals as $journal)
                                <div class="col-md-4 pb-4" onclick="window.location='{{ url('journal/' . $journal->slug) }}'" style="cursor: pointer;">
                                    <div class="text-center">
                                        <div>
                                            <img class="img-fluid"
                                            src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="Image"
                                            style=" width: 80%; object-fit: contain;"
                                            >
                                        </div>
                                        <div class="h-box p-2">
                                            {{ $journal->j_name }}
                                        </div>
                                    </div>


                                </div>
                            @endforeach

                        </div>

                    </div>



                </div>

                <!-- RIGHT SIDEBAR -->

                <div class="col-md-3">



                    @include('partials.quicklinks1')
                    @include('partials.top_editors')


                </div>
             



            </div>
        </div>
    </div>





@endsection
