@extends('layouts.app')

@section('title', 'Archives')

@section('content')

    <div>
        <!-- MAIN CONTENT GRID -->
        <div class="container mt-4">

            <div class="row">

                <!-- LEFT SECTION -->
                <div class="col-md-9">
                    <div class="card cus-padding">

                        <h4>Archives</h4>
                        <br>

                        <div class="accordion" id="accordionExample">


                            @foreach ($data as $year => $issues)
                                <div class="accordion-item">

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
                                        aria-labelledby="heading-{{ $loop->iteration }}" data-bs-parent="#accordionExample">

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

                                </div>
                            @endforeach



                            <br>
                            <br>
                            <br>
                            <br>




                            {{-- <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Accordion Item #1
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by default,
                                        until the collapse plugin adds the appropriate classes that we use to style each
                                        element. These classes control the overall appearance, as well as the showing and
                                        hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                        our default variables. It's also worth noting that just about any HTML can go within
                                        the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Accordion Item #2
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                        until the collapse plugin adds the appropriate classes that we use to style each
                                        element. These classes control the overall appearance, as well as the showing and
                                        hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                        our default variables. It's also worth noting that just about any HTML can go within
                                        the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                        until the collapse plugin adds the appropriate classes that we use to style each
                                        element. These classes control the overall appearance, as well as the showing and
                                        hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                        our default variables. It's also worth noting that just about any HTML can go within
                                        the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div> --}}


                        </div>
                    </div>



                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="col-md-3">



                    @include('partials.right')


                </div>



            </div>
        </div>
    </div>





@endsection
