@extends('layouts.app')

@section('title', 'Indexing')

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

                    <div>


                         @include('partials.indexings')

                        {{-- <div class="card-c">

                            <div class="card-header">
                                <div class="h-box">
                                    <div class="h-box-text p-2">
                                        Indexings | {{ $journal->j_name }}
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row px-4 pb-4">

                                @foreach ($indexings as $i)
                                    <div class="col-md-3 mb-4">
                                        <div class="card-c h-100 p-2 flex-bottom">



                                            <img class="img-fluid" src="{{ url('/assets/indexing/img/' . $i->img) }}"
                                                alt="Image" style=" width: 100%; object-fit: contain;">

                                           
                                        </div>
                                    </div>
                                @endforeach





                            </div>




                        </div> --}}

                    </div>

                    <div>





                    </div>






                </div>






            </div>
        </div>
    </div>





@endsection
