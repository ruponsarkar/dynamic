@extends('layouts.app')

@section('title', $data->meta_title)

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    <div class="card-c cus-padding">
                        {!! $data->data !!}
                    </div>



                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="col-md-3">



                    @include('partials.quicklinks1')
                    {{-- @include('partials.top_editors') --}}


                </div>



            </div>
        </div>
    </div>


@endsection
