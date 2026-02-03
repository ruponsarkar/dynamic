@extends('layouts.app')

@section('title', 'Journals')

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

                    <div>



                        <div class="card-c">

                            <div class="card-header">
                                <div class="h-box">
                                    <div class="h-box-text p-2">
                                        {{ $journal->j_name }}
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row px-4 pb-4">

                                <div>
                                    Journal Title: {{ $journal->j_name }}
                                </div>

                                <div>
                                    Abbreviated Key Title: {{ $journal->abbr_title }}

                                </div>
                                <div>
                                    ISSN: {{ $journal->issn }}
                                </div>
                                <div>

                                    Frequency: {{ $journal->frequency }}
                                </div>
                                <div>

                                    Subject: {{ $journal->subject }}
                                </div>
                                <div>

                                    Language: {{ $journal->language }}
                                </div>
                                <div>

                                    Format: {{ $journal->format }}
                                </div>
                                <div>

                                    {{-- Starting Year: {{ $journal->starting_year }} --}}
                                </div>

                                <div>

                                    Publisher: {{ $journal->publisher }}
                                </div>

                                <div>

                                    Origin: {{ $journal->country_of_origin }}
                                </div>
                                {{-- Address: 204, Borhawar, Murajhar, Hojai, Assam- 782439 --}}



                            </div>


                            <div class="p-4">
                                <b>Aim and scope</b>
                                {!! $journal->aim_and_scope !!}
                            </div>

                        </div>

                    </div>

                    <div>




                        <div class="card-c mt-3">

                            <div class="card-header">
                                <div class="h-box">
                                    <div class="h-box-text p-2">
                                        Recent Articles
                                    </div>
                                </div>
                            </div>
                            <br>

                            @include('partials.articles')

                            {{-- <div class="p-2">
                                @foreach ($recent as $article)
                                    <div class="card-c p-3 mb-2">



                                        <div>
                                            <b>
                                                {{ $article->name }}
                                            </b>
                                        </div>
                                        <div>
                                            <b>Author(s):</b>{{ $article->aname }}
                                        </div>

                                        <div>
                                            <b>DOI:</b>{{ $article->doi }}
                                        </div>
                                        <div>
                                            <b>Page:</b>{{ $article->page }}
                                        </div>

                                        <div>
                                            <a href="/article/{{ $article->slug}}">View</a>
                                            <a href="">Download PDF</a>
                                        </div>


                                    </div>
                                @endforeach
                            </div> --}}

                        </div>

                    </div>






                </div>

                <!-- RIGHT SIDEBAR -->

                {{-- @foreach ($recent as $article)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="h-box">
                                            <div class="h-box-text p-2">
                                                {{ $article->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}




            </div>
        </div>
    </div>





@endsection
