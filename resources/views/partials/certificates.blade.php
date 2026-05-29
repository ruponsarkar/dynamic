<div>
    <div class="card-c mb-2">

        <div class="card-header">
            <div class="h-box">
                <div class="h-box-text p-2">
                    Certificates
                </div>
            </div>
        </div>

        <div class="container p-2">
            <div class="indexing-slider swiper">
                <div class="swiper-wrapper align-items-center">

                    @foreach ($certificates as $certificate)
                        <div class="swiper-slide">
                            <img class="img-fluid"
                                src="{{ url('assets/certificates/img/' . $certificate->img) }}"
                                alt="{{ $certificate->title ?: 'Certificate' }}"
                                style=" width: 100%; object-fit: contain;"
                                >
                            @if ($certificate->title)
                                <div class="text-center mt-2 small">{{ $certificate->title }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>



    </div>

</div>
