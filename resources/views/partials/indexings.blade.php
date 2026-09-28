<div class="card-c p-2">
    <div class="row">

        <h2 class="text-center" style="color: #1976d2; font-weight: bold;">Indexing & Abstracting</h2>

         @foreach ($indexings as $index)

        <div class="col-md-2 mb-3">
            <div class="bg-light p-3">
                <div class="text-center">
                    {{-- <div>Journals</div> --}}
                    @php($indexingUrl = \App\Support\PublicationLinks::indexing($index->link ?? null))
                    @if ($indexingUrl)
                        <a href="{{ $indexingUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Visit indexing service">
                            <img src="{{ url('assets/indexing/img/' . $index->img) }}" alt="Indexing service" class="col-12">
                        </a>
                    @else
                        <img src="{{ url('assets/indexing/img/' . $index->img) }}" alt="Indexing service" class="col-12">
                    @endif
                </div>
            </div>
        </div>

        @endforeach


       

    </div>
</div>

    