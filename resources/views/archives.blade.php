@extends('layouts.app')

@section('title', 'Archives')

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

                <div class="col-md-3">
                    <div class="card-c mb-3">
                        <img class="img-fluid"
                                src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="Image"
                                style=" width: 100%; object-fit: contain;"
                                >
                    </div>

                    @include('partials.quicklinks2')
                </div>

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    <div class="card-c p-4">

                        <div class="card-header">
                            <div class="h-box">
                                <div class="h-box-text p-2">
                                    Archives | {{ $journal->j_name }}
                                </div>
                            </div>
                        </div>

                        <br>

                        <div>


                            @foreach ($data as $year => $issues)
                                <div class="mb-3 card-c p-2">
                                    

                                    <div>
                                        <div class="btn btn-primary disabled w-100 text-center mb-2">
                                            <b>
                                                {{ $issues[0]->volume_name }}
                                            </b>
                                        </div>
                                        <div class="row gap-4">
                                        @foreach ($issues as $issue)

                                            <div class="col-md-3 text-center">
                                                    <a href="/archives/{{ $journal->slug }}/{{ $issue->volume_slug }}/{{ $issue->slug }}?i={{ $issue->id }}&v={{ $issue->v_id }}" class="btn btn-primary w-100">
                                                        {{ $issue->name }}
                                                    </a>
                                                    
                                                    </div>
                                                    @endforeach
                                                </div>

                                    </div>

                                </div>


                                {{-- <div class="accordion-item">

                                    <h2 class="accordion-header" id="heading-{{ $loop->iteration }}">
                                        <button class="accordion-button {{ $loop->iteration === 1 ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->iteration }}"
                                            aria-expanded="{{ $loop->iteration === 1 ? 'true' : 'false' }}"
                                            aria-controls="collapse-{{ $loop->iteration }}">
                                            Archive Issues - {{ $year }}
                                        </button>
                                    </h2>

                                    <div id="collapse-{{ $loop->iteration }}"
                                        class="accordion-collapse collapse {{ $loop->iteration === 1 ? 'show' : '' }}"
                                        aria-labelledby="heading-{{ $loop->iteration }}"
                                        data-bs-parent="#accordionExample">

                                        <div class="accordion-body">

                                            @foreach ($issues as $issue)
                                                <div class="mb-1">
                                                    <a href="/archives/{{ $issue->volume_slug }}/{{ $issue->slug }}"
                                                        class="text-primary">
                                                        {{ $issue->volume_name }} - {{ $issue->name }}
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </div> --}}
                            @endforeach



                            <br>
                            <br>
                            <br>
                            <br>



                        </div>
                    </div>



                </div>

         



            </div>
        </div>
    </div>





@endsection
