@extends('layouts.app')

@section('title', 'All Journals')

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

              

                <!-- LEFT SECTION -->
                <div class="col-md-12">
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
                                <div class="col-md-6 pb-4" onclick="window.location='{{ url('journal/' . $journal->slug) }}'" style="cursor: pointer;">
                                    <div class="card-c p-3">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <img class="img-fluid"
                                                src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="Image"
                                                style=" width: 80%; object-fit: contain;"
                                                >
                                            </div>
                                            <div class="col-md-8">
                                                <div>
                                                    <b>
                                                        {{ $journal->j_name }}
                                                    </b>
                                                </div>

                                                <div>
                                                    ISSN: {{ $journal->issn }}
                                                </div>
                                                <div>
                                                    <small>

                                                        Frequency: {{ $journal->frequency }}
                                                    </small>
                                                </div>
                                                <div>
                                                    <small>

                                                        Publisher: {{ $journal->publisher }}
                                                    </small>
                                                </div>
                                                <div>
                                                    <small>

                                                        Country of Origin: {{ $journal->country_of_origin }}
                                                    </small>
                                                </div>

                                                <div>
                                                    <button class="btn btn-primary btn-sm">View Journal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @endforeach

                        </div>

                    </div>



                </div>

                <!-- RIGHT SIDEBAR -->

                {{-- <div class="col-md-3">



                    @include('partials.quicklinks1')
                    @include('partials.top_editors')


                </div> --}}
             



            </div>
        </div>
    </div>





@endsection
