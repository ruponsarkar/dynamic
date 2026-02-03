<div>
    <div class="card-c mt-2">
        <section id="indexing" class="indexing">
            <div class="h-box">
                <div class="h-box-text p-2">
                    Top Editors
                </div>
            </div>
            <div class="container p-2">
                <div class="indexing-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        @foreach ($top_editors as $data)
                            <div class="swiper-slide">
                                <img class="img-fluid"
                                    src="{{ url('/assets/img/editor-img/' . $data->image) }}" alt="Image"
                                    style=" width: 100%; object-fit: contain;"
                                    >
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>