@extends('layouts.app')

@section('title', 'Editorial Board')

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

                                @foreach ($editors as $editor)
                                    <div class="col-md-3 mb-2 p-2">
                                        <div class="card-c h-100 p-2 flex-bottom">

                                            <div>
                                                {{-- <b>{{ $editor->type }} Editor</b> --}}
                                                @if ($editor->type === 'Chief')
                                                    <span class="badge bg-primary">Chief Editor</span>
                                                @elseif ($editor->type === 'Associative')
                                                    <span class="badge bg-secondary">Associate editor</span>
                                                @else
                                                    <b>{{ $editor->type }} Editor</b>
                                                @endif

                                                <hr class="p-0 m-0">
                                            </div>

                                            <img class="img-fluid"
                                                src="{{ url('/assets/img/editor-img/' . $editor->image) }}" alt="Image"
                                                style=" width: 100%; object-fit: contain;">

                                            <div class="text-center details-section"
                                                style="max-width: 100%; overflow-wrap: anywhere; word-break: break-word; white-space: normal;">
                                                <div>
                                                    <small> <b>{{ $editor->name }}</b> </small>
                                                </div>
                                                <div>
                                                    <small> {{ $editor->designation }} </small>
                                                </div>
                                                <div>
                                                    <small> <i> {{ $editor->university }} </i> </small>
                                                </div>
                                                <div>
                                                    <small> {{ $editor->details }} </small>
                                                </div>
                                                <div>
                                                    <small>
                                                        Profile link: 
                                                        <a href="{{ $editor->profile }}" target="_blank"
                                                            style="overflow-wrap: anywhere; word-break: break-word;">
                                                            {{ $editor->profile }}
                                                        </a>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach





                            </div>




                        </div>

                    </div>

                    <div>





                    </div>






                </div>






            </div>
        </div>
    </div>





@endsection
