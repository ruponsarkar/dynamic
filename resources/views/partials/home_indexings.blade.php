@if (isset($homeIndexings) && $homeIndexings->count())
    <section class="py-2">
        <div class="card-c">
            <div class="card-header">
                <div class="h-box">
                    <div class="h-box-text p-2">
                        Indexing
                    </div>
                </div>
            </div>

            <div class="container p-3">
                <div class="row g-3">
                    @foreach ($homeIndexings as $indexing)
                        <div class="col-6 col-md-3">
                            <div class="card-c h-100 p-2 text-center" style="border: 0; display: flex; border-radius: 10px; align-content: center; align-items: center;">
                                <a href="{{ $indexing->link }}" target="_blank" rel="noopener noreferrer">
                                    <img class="img-fluid" src="{{ url('assets/indexing/img/' . $indexing->img) }}"
                                        alt="Indexing" style="width: 100%; object-fit: contain;">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
