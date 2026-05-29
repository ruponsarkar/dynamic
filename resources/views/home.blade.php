@extends('layouts.app')

@section('title', 'IRGS Publisher')

{{-- <style>
    .journal-slider {
    visibility: hidden;
}

.journal-slider.swiper-initialized {
    visibility: visible;
}
</style> --}}

@section('content')



    <div class="">



        <div class="container-fluid pb-3">

            <div class="row">
                <div class="col-md-12">
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

                                        {{-- <div>
                                            <h2>Welcome to <span>GSASR Publisher</span></h2>
                                            <h3>A publisher of scholarly journals and other academic resources.</h3>
                                        </div> --}}
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

                                        {{-- <div>
                                            <h2>Submit you manuscript here</h2>
                                            <div class="text-center">
                                                <button class="btn btn-primary">Submit Your Manuscript</button>
                                            </div>
                                        </div> --}}
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
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">

                    <section class="py-2">
                        <div>
                            <div class="journal-slider swiper">
                                <div class="swiper-wrapper align-items-center">

                                    @foreach ($journals as $journal)
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{ url('assets/journals/img/' . $journal->photo) }}"
                                                alt="Image" style=" width: 100%; object-fit: contain;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>



                    <section class="py-2">
                        <div class="card-c py-4">
                            <div class="p-3 text-center">
                                <h2 style="color: #1976d2; font-weight: bold;">Advancing Research Worldwide</h2>
                                <div>
                                    Submit your research, explore journals, and publish with confidence.
                                </div>
                                <div class="mt-3">
                                    <a href="/manuscript" class="btn btn-primary">Submit Manuscript</a>
                                    <a href="/journals" class="btn btn-danger">Explore Journals</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="py-2">
                        <div class="card-c py-4">
                            <div class="p-3 text-center">


                                <h2 style="color: #1976d2; font-weight: bold;">About IRGS Publisher</h2>
                                <div>
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
                        </div>
                    </section>

                    <section class="py-2">
                        <div class="card-c py-4">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="p-3 text-center">
                                        <h2 style="color: #1976d2; font-weight: bold;">OUR AIMS</h2>

                                        <div style="text-align: justify">
                                            @php
                                                $data = $contents->firstWhere('path', 'home.aim');
                                            @endphp
                                            @if ($data)
                                                <b>{!! $data->page_title !!}</b>
                                                {!! $data->data !!}
                                            @else
                                                <p class="text-danger">No content found for home.about</p>
                                            @endif
                                        </div>
                                    </div>

                                </div> --}}
                                <div class="col-md-12">
                                    <div class="p-3 text-center">
                                        <h2 style="color: #1976d2; font-weight: bold;">Our Aim & Scopes</h2>
                                        <div style="text-align: justify">
                                            @php
                                                $data = $contents->firstWhere('path', 'home.scopes');
                                            @endphp
                                            @if ($data)
                                                <b>{!! $data->page_title !!}</b>
                                                {!! $data->data !!}
                                            @else
                                                <p class="text-danger">No content found for home.about</p>
                                            @endif
                                        </div>

                                        {{-- <div>
                                            UKR Publisher welcomes interdisciplinary research spanning science, technology,
                                            medicine, social sciences, humanities, and applied sciences. We publish
                                            theoretical, experimental, and review articles that contribute new insights and
                                            advancements to the academic community. Our journals prioritize originality,
                                            ethical research practices, and methodological rigor to support the global
                                            exchange of knowledge.
                                        </div> --}}



                                    </div>

                                </div>
                            </div>

                        </div>
                    </section>


                    <section class="py-2">
                        <div class="card-c">
                            <div class="p-3">


                                <h2 class="text-center" style="color: #1976d2; font-weight: bold;">Our Mission</h2>

                                @php
                                    $data = $contents->firstWhere('path', 'home.mission');
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
                    <section class="py-2">
                        <div class="card-c">
                            <div class="p-3">


                                <h2 class="text-center" style="color: #1976d2; font-weight: bold;">Our Vision</h2>

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



                    <section class="py-2">
                        <div class="card-c p-2">

                            <div class="p-3">
                                <h2 class="text-center" style="color: #1976d2; font-weight: bold;">Why Publish With IRGS
                                    Publisher</h2>

                                <div
                                    style="font-size:11.0pt;line-height: 115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
                                        mso-fareast-theme-font:minor-fareast;mso-ansi-language:EN-US;mso-fareast-language:
                                        EN-US;mso-bidi-language:AR-SA">
                                    IRGS Publisher provides a professional and transparent platform for researchers and
                                    academicians to publish their scholarly work. Our journals aim to promote high-quality
                                    research and global knowledge sharing through open access publishing.
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="text-center">
                                            <div style="font-size: 34px; color: #1976d2;">
                                                {{-- <i class="fa-book-open-reader"></i> --}}
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div> <b> Peer-Reviewed Journals </b> </div>
                                            <div>
                                                All submitted manuscripts undergo a rigorous peer-review process to ensure
                                                research quality and academic integrity.

                                                <br>
                                                <br>
                                                <br>

                                            </div>

                                            {{-- <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="text-center">

                                            <div style="font-size: 34px; color: #1976d2;">
                                                <i class="bi bi-unlock"></i>
                                            </div>
                                            <div> <b> Open Access Publishing </b> </div>
                                            <div>
                                                Published articles are freely accessible to readers worldwide, increasing
                                                research visibility and impact.

                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            {{-- <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="text-center">

                                            <div style="font-size: 34px; color: #1976d2;">
                                                <i class="bi bi-globe2"></i>
                                            </div>
                                            <div> <b> Global Research Visibility </b> </div>
                                            <div>
                                                Our journals provide international exposure for authors from different
                                                academic and professional backgrounds.
                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            {{-- <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="text-center">
                                            <div style="font-size: 34px; color: #1976d2;">
                                                <i class="bi bi-lightning-charge"></i>
                                            </div>
                                            <div> <b> Fast Review Process</b> </div>
                                            <div>
                                                Efficient editorial and peer-review procedures ensure timely publication of
                                                accepted manuscripts.

                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            {{-- <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="text-center">
                                            <div style="font-size: 34px; color: #1976d2;">
                                                <i class="bi bi-shield-check"></i>
                                            </div>
                                            <div> <b> Ethical Publishing Standards </b> </div>
                                            <div>
                                                IRGS Publisher follows internationally recognized ethical guidelines in
                                                academic publishing.

                                                <br>
                                                <br>
                                                <br>
                                                <br>

                                            </div>

                                            {{-- <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="text-center">

                                            <div style="font-size: 34px; color: #1976d2;">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                            <div> <b> Multidisciplinary Research Coverage </b> </div>
                                            <div>
                                                Our journals cover a wide range of academic disciplines including science,
                                                technology, medicine, agriculture, social sciences, and business.

                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            {{-- <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>







                    <section class="py-2">
                        @include('partials.indexings')
                    </section>

                    <section class="py-2">
                        {{-- @include('partials.counts') --}}
                    </section>





                </div>






                {{-- right side   --}}

                <div class="col-md-3">
                    <section class="mb-3">
                        @include('partials.top_editors')
                    </section>

                    <section class="mb-3">
                        @include('partials.certificates')
                    </section>


                    <section class="mb-3">
                        <div class="card-c">
                            <div>
                                <div class="card-header">
                                    <div class="h-box">
                                        <div class="h-box-text p-2">
                                            Recent Articles
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('partials.articles')
                        </div>
                    </section>
                    @include('partials.quicklinks1')
                </div>
            </div>



        </div>
    </div>







@endsection
