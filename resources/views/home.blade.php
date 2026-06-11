@extends('layouts.app')

@section('title', 'Research Journal of Medical Science')

<style>
    .sidebar-btn {
        background: #004d4f;
        color: white !important;
        border-radius: 6px;
        font-weight: 600;
        transition: opacity 0.3s;
    }
</style>

@section('content')



    <div class="">



        <div class="container pb-3">

            <div class="row">



                <div class="col-md-3">

                    <div>
                        <div class="mt-3">
                            <a href="/submit-article" class="sidebar-btn py-3 text-center d-block mb-2 shadow-sm">
                                <i class="bi bi-upload"></i> Submit Manuscript
                            </a>
                            <a href="{{ session()->has('AuthorLoggedUser') ? route('author.dashboard') : route('author.login') }}"
                                class="sidebar-btn py-3 text-center d-block mb-2 shadow-sm">
                                <i class="bi bi-person-circle"></i> Author Login
                            </a>
                        </div>
                    </div>


                    <div class="card-c mt-2">
                        <section id="indexing" class="indexing">
                            <div class="h-box">
                                <div class="h-box-text p-2">
                                    Journal Catalog
                                </div>
                            </div>
                            <div class="container p-2">
                                <div class="indexing-slider swiper">
                                    <div class="swiper-wrapper align-items-center" style="height: auto;">

                                        @foreach ($journals as $journal)
                                            <div class="swiper-slide">
                                                <img class="img-fluid"
                                                    src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="Image"
                                                    style=" width: 100%; object-fit: contain;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>


                    {{-- <section class="mb-3">
                        @include('partials.top_editors')
                    </section>

                    <section class="mb-3">
                        @include('partials.certificates')
                    </section> --}}


                    {{-- <section class="mb-3">
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
                    </section> --}}

                    <section class="pt-2">
                        @include('partials.quicklinks1')
                    </section>
                </div>



                <div class="col-md-9">

                    {{-- <section class="py-2">
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
                    </section> --}}

                    <section class="py-2">
                        <div class="card-c py-4">
                            <div class="p-3">


                                <h2 style="color: #1976d2; font-weight: bold;">Journal Overview</h2>
                                <div>
                                    @php
                                        $data = $contents->firstWhere('path', 'home.Journal-Overview');
                                    @endphp
                                    @if ($data)
                                        {{-- <b>{!! $data->page_title !!}</b> --}}
                                        {!! $data->data !!}
                                    @else
                                        <p class="text-danger">No content found for home.about</p>
                                    @endif
                                </div>



                            </div>
                        </div>
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
                            <div>
                                <div class="row p-2">
                                    @foreach ($articles as $article)
                                        <div class="col-md-6 mb-3 d-flex">
                                            <div class="card-c p-3 article-card-wrap w-100 d-flex flex-column"
                                                style="word-break: break-word;">

                                                <div class="text-muted">
                                                    <b> <small>{{ $article->article_type }}</small></b>
                                                </div>
                                                <hr class="p-1 m-0">

                                                <div>
                                                    <b><a class="text-dark"
                                                            href="/article/{{ $article->slug }}">{{ $article->name }}</a></b>
                                                </div>

                                                <div>
                                                    <b>Author(s):</b> {{ $article->aname }}
                                                </div>

                                                @if ($article->doi)
                                                    <div>
                                                        <b>DOI:</b> <a class="text-dark" href="{{ $article->doi_link }}"
                                                            target="_blank">{{ $article->doi }}</a>
                                                    </div>
                                                @endif

                                                <div>
                                                    <b>Page:</b> {{ $article->page }}
                                                </div>

                                                <div class="article-card-links mt-auto">
                                                    <a href="/article/{{ $article->slug }}">View</a>
                                                    <a href="/assets/articles/{{ $article->file }}">Download PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>




                    {{-- <section class="py-2">
                        <div class="card-c py-4">
                            <div class="p-3 text-center">


                                <h2 style="color: #1976d2; font-weight: bold;">About RJMS Publisher</h2>
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
                    </section> --}}

                    {{-- <section class="py-2">
                        <div class="card-c py-4">
                            <div class="row">
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
                                    </div>

                                </div>
                            </div>

                        </div>
                    </section> --}}


                    {{-- <section class="py-2">
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
                    </section> --}}


                    {{-- <section class="py-2">
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
                    </section> --}}



                    <section class="py-2">
                        <div class="card-c p-2">

                            <div class="p-3">
                                <h2 class="" style="color: #1976d2; font-weight: bold;">Why Publish With RJMS
                                    Publisher</h2>

                                <div
                                    style="font-size:11.0pt;line-height: 115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
                                        mso-fareast-theme-font:minor-fareast;mso-ansi-language:EN-US;mso-fareast-language:
                                        EN-US;mso-bidi-language:AR-SA">
                                    RJMS Publisher provides a professional and transparent platform for researchers and
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
                                                RJMS Publisher follows internationally recognized ethical guidelines in
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
                        {{-- @include('partials.counts') --}}
                    </section>





                </div>






                {{-- right side   --}}


            </div>

            <section class="py-2">
                @include('partials.indexings')
            </section>



        </div>
    </div>







@endsection
