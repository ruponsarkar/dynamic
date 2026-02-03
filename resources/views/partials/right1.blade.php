<div>
    <div class="card-c mb-2">

        <div class="card-header">
            <div class="h-box">
                <div class="h-box-text p-2">
                    Journals
                </div>
            </div>
        </div>

        <div class="container p-2">
            <div class="indexing-slider swiper">
                <div class="swiper-wrapper align-items-center">

                    @foreach ($journals as $journal)
                        <div class="swiper-slide">
                            <img class="img-fluid"
                                src="{{ url('assets/Journals/img/' . $journal->photo) }}" alt="Image"
                                style=" width: 100%; object-fit: contain;"
                                >
                        </div>
                    @endforeach
                </div>
            </div>

        </div>



    </div>

</div>
