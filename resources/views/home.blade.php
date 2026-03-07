@extends('layouts.app')

@section('title', 'GSASR Publisher')


@section('content')



    <div class="">



        <div class="container pb-3">

            <div class="row">
                <div class="col-md-9">
                    <section id="hero">
                        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

                            <!-- Indicators -->
                            <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

                            <div class="carousel-inner">

                                <!-- Slide 1 -->
                                <div class="carousel-item active"
                                    style="background: url('{{ asset('assets/banner/j.jpg') }}') center center;">
                                    <div class="carousel-container">
                                        {{-- <div class="container text-center">
                                            <h2>Welcome to <span>Your School Name</span></h2>
                                            <p>Providing world-class education for every student.</p>
                                            <a href="#about" class="btn-get-started scrollto">Learn More</a>
                                        </div> --}}

                                        <div>
                                            <h2>Welcome to <span>GSASR Publisher</span></h2>
                                            <h3>A publisher of scholarly journals and other academic resources.</h3>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide 2 -->
                                <div class="carousel-item"
                                    style="background: url('{{ asset('assets/banner/j2.jpg') }}') center center;">
                                    <div class="carousel-container">
                                        {{-- <div class="container text-center">
                                            <h2>Smart Classrooms</h2>
                                            <p>Interactive smart learning for a brighter future.</p>
                                            <a href="#academics" class="btn-get-started scrollto">Academics</a>
                                        </div> --}}

                                        <div>
                                            <h2>Submit you manuscript here</h2>
                                            <div class="text-center">
                                                <button class="btn btn-primary">Submit Your Manuscript</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           


                            </div>
                            
                            <!-- Navigation -->
                            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bi bi-chevron-left"></span>
                            </a>

                            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon bi bi-chevron-right"></span>
                            </a>

                        </div>
                    </section>



                    <section class="py-2">
                        <div class="card-c">
                            <div class="p-3">
        
                                @php
                                    $data = $contents->firstWhere('path', 'home.about');
                                @endphp
                                @if ($data)
                                <b>{!! $data->page_title !!}</b>
                                    {!! $data->data !!}
                                @else
                                    <p class="text-danger">No content found for home.about</p>
                                @endif
        
                            </div>
                        </div>
                    </section>

                    <section class="py-2">
                        <div class="card-c">
                            <div class="p-3">
        
                                @php
                                    $data = $contents->firstWhere('path', 'home.mission');
                                @endphp
                                @if ($data)
                                <b>{!! $data->page_title !!}</b>
                                    {!! $data->data !!}
                                @else
                                    <p class="text-danger">No content found for home.mission</p>
                                @endif
        
                            </div>
                        </div>
                    </section>

                    <section class="py-2">
                        <div class="card-c">
                            <div class="p-3">
        
                                @php
                                    $data = $contents->firstWhere('path', 'home.vision');
                                @endphp
                                @if ($data)
                                <b>{!! $data->page_title !!}</b>
                                    {!! $data->data !!}
                                @else
                                    <p class="text-danger">No content found for home.vision</p>
                                @endif
        
                            </div>
                        </div>
                    </section>



                    <section>
                        @include('partials.counts')
                    </section>


                </div>






                {{-- right side   --}}

                <div class="col-md-3">
                    @include('partials.right1')
                    @include('partials.quicklinks1')
                    @include('partials.top_editors')
                </div>
            </div>



        </div>
    </div>







@endsection
