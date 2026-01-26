@extends('layouts.app')

@section('title',  $journal->j_name )

@section('content')



    <div class="big-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="big-banner-title">
                        {{-- P-Edu International Journal of Multidisciplinary Studies --}}
                        {{ $journal->j_name }}
                    </div>

                    <div class="">
                        <p class=" "><b>ISSN (Online):</b>  {{ $journal->issn }}<br>
                            <b>Frequency: </b>{{ $journal->frequency }}<br>
                          
                            <b>Editor in Chief:</b> {{ $journal->chief_editor }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">

                    <div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="/instructons-for-authors" class="btn btn-success" type="button">Author Guidelines</a>
                            <a href="/manuscript" class="btn btn-primary" type="button">Submit Your Article</a>
                            <a href="/archives" class="btn btn-primary" type="button">Archives</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- MAIN CONTENT GRID -->
    <div class="container mt-4">

        <div class="row">

            <!-- LEFT SECTION -->
            <div class="col-md-9">

                <!-- ABOUT JOURNAL -->
                {{-- <div class="section-title">About the Journal</div> --}}

                <div class="cus-padding shadow-sm" style="min-height: 250px; background-color: #ebd688">
                    {!! $journal->aim_and_scope !!}
                </div>

                <div class="card">
                    <div class="cus-padding">

                        @php
                            $data = $contents->firstWhere('path', 'home.Open-Access-Journal');
                        @endphp
                        @if ($data)
                            {!! $data->data !!}
                        @else
                            <p class="text-danger">No content found for home.Open-Access-Journal</p>
                        @endif

                    </div>
                </div>


            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-md-3">



                @include('partials.right')


            </div>



        </div>
    </div>




@endsection
