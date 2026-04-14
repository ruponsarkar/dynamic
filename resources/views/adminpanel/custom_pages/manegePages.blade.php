@extends('adminpanel/custom_pages/cus_layout')

@section('customPage')
    <div class="bg-white p-3">



        <div class="card p-3">

            <div class="card p-3">
                <h5>Pages</h5>
                <div class="row">
                    @foreach ($pages as $p)
                        <div class="col-3 p-4 border">
                            <a class="py-2" href="/custom_pages/{{ $p->path }}">{{ $p->path }}</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card p-3">
                <h5>Content</h5>
                <div class="row">
                    @foreach ($content as $c)
                        <div class="col p-4 border">
                            <a class="py-2" href="/custom_pages/{{ $c->path }}">{{ $c->path }}</a>
                        </div>
                    @endforeach
                </div>
            </div>


            <a href="/add-custom">...</a>

        </div>

    </div>
@endsection
