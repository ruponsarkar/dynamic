@extends('layouts.app')

@section('title', 'Certificates')

@section('content')
    <div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card-c mb-3">
                        <img class="img-fluid" src="{{ url('assets/journals/img/' . $journal->photo) }}" alt="Image"
                            style="width: 100%; object-fit: contain;">
                    </div>

                    @include('partials.quicklinks2')
                </div>

                <div class="col-md-9">
                    <div class="card-c">
                        <div class="card-header">
                            <div class="h-box">
                                <div class="h-box-text p-2">
                                    Certificates | {{ $journal->j_name }}
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row px-4 pb-4">
                            @forelse ($certificates as $certificate)
                                <div class="col-md-4 mb-4">
                                    <div class="card-c h-100 p-2">
                                        <img class="img-fluid"
                                            src="{{ url('/assets/certificates/img/' . $certificate->img) }}"
                                            alt="{{ $certificate->title ?: 'Certificate' }}"
                                            style="width: 100%; object-fit: contain;">
                                        @if ($certificate->title)
                                            <div class="text-center mt-2">
                                                <small><b>{{ $certificate->title }}</b></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center mb-0">No certificates found for this journal.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
