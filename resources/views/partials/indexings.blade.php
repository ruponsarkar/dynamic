<div class="card-c p-2">
    <div class="row">

        <h2 class="text-center" style="color: #1976d2; font-weight: bold;">Indexing & Abstracting</h2>

         @foreach ($indexings as $index)

        <div class="col-md-2 mb-3">
            <div class="bg-light p-3">
                <div class="text-center">
                    {{-- <div>Journals</div> --}}
                    <img src="{{ url('assets/indexing/img/' . $index->img) }}" alt="" class="col-12">
                </div>
            </div>
        </div>

        @endforeach


       

    </div>
</div>

    