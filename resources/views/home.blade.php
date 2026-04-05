@extends('layouts.app')

@section('title', 'GSASR Publisher')

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
                                <h2 style="color: #1976d2; font-weight: bold;">Step Into Scholarly Excellence </h2>
                                <div>
                                    Access all UKR Publisher services in one place—submit manuscripts, explore journals, and
                                    track your submissions.
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary">Submit Manuscript</button>
                                    <button class="btn btn-danger">Explore Journals</button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="py-2">
                        <div class="card-c py-4">
                            <div class="p-3 text-center">


                                <h2 style="color: #1976d2; font-weight: bold;">Know → Who We Are?</h2>
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
                                <div class="col-md-6">
                                    <div class="p-3 text-center">
                                        <h2 style="color: #1976d2; font-weight: bold;">OUR AIMS</h2>
                                        <div>
                                            UKR Publisher aims to provide a high-quality, open-access platform for the
                                            global research community. We strive to advance scholarly knowledge by
                                            publishing original, peer-reviewed research across multiple disciplines. Our
                                            goal is to foster academic collaboration, encourage innovation, and ensure free
                                            and immediate access to impactful research.
                                        </div>



                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 text-center">
                                        <h2 style="color: #1976d2; font-weight: bold;">SCOPES</h2>
                                        <div>
                                            UKR Publisher welcomes interdisciplinary research spanning science, technology,
                                            medicine, social sciences, humanities, and applied sciences. We publish
                                            theoretical, experimental, and review articles that contribute new insights and
                                            advancements to the academic community. Our journals prioritize originality,
                                            ethical research practices, and methodological rigor to support the global
                                            exchange of knowledge.
                                        </div>



                                    </div>

                                </div>
                            </div>

                        </div>
                    </section>


                    <section class="py-2">
                        <div class="card-c">
                            <div class="p-3">


                                <h2 class="text-center" style="color: #1976d2; font-weight: bold;">OUR VISION</h2>

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

                    {{-- <section class="py-2">
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
                    </section> --}}







                    <section class="py-2">
                        @include('partials.indexings')
                    </section>

                    <section class="py-2">
                        @include('partials.counts')
                    </section>


                    <section class="py-2">
                        <div class="card-c p-2">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="">
                                            <div> <b> About UKR Publisher </b> </div>
                                            <div>
                                                UKR Publisher (Universal Knowledge Research) is an international online
                                                publisher established to accelerate the dissemination of high-quality
                                                scholarly research. We publish peer-reviewed, open access journals across
                                                disciplines, ensuring rigorous evaluation, editorial transparency, and
                                                global reach.
                                            </div>

                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="">
                                            <div> <b> Author Guidelines </b> </div>
                                            <div>
                                                To ensure consistent presentation and fast processing, authors should follow
                                                our formatting templates: structured abstract, clear sections, limited
                                                references, and ethics statement. File types: DOCX or PDF; high-resolution
                                                figures encouraged.
                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="">
                                            <div> <b> Publication Ethics </b> </div>
                                            <div>
                                                UKR Publisher enforces strict policies on plagiarism and redundant
                                                publication. Authors must disclose conflicts, funding, and approvals.
                                                Suspected misconduct is investigated to maintain integrity and transparency.
                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="">
                                            <div> <b> Peer Review Process</b> </div>
                                            <div>
                                                Double-blind peer review ensures impartial evaluation. Editors assign expert
                                                reviewers providing constructive feedback and timely decisions to maintain
                                                high academic standards.
                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="">
                                            <div> <b> For Reviewers </b> </div>
                                            <div>
                                                Reviewers play a crucial role in maintaining research quality. They provide
                                                thorough, unbiased evaluations, offer constructive feedback, and uphold
                                                ethical standards. Reviewers are recognized for their contributions and
                                                guided through clear review workflows.
                                            </div>

                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 card-c">
                                        <div class="">
                                            <div> <b> Copyrights </b> </div>
                                            <div>
                                                Articles are under Creative Commons licenses, allowing reuse with
                                                attribution. Authors retain copyright; the publisher holds a non-exclusive
                                                license for distribution.
                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary">Read More</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
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
