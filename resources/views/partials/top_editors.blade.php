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

                        @forelse (($top_editors ?? collect()) as $data)
                            <div class="swiper-slide">
                                <img class="img-fluid"
                                    src="{{ url('/assets/img/editor-img/' . $data->image) }}" alt="Image"
                                    style=" width: 100%; object-fit: contain;"
                                    >
                            </div>
                        @empty
                            <div class="swiper-slide text-muted">Editor profiles will be available soon.</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
