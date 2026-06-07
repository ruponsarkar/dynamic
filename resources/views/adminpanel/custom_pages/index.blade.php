@extends('adminpanel/custom_pages/cus_layout')

@section('customPage')
    <div class="bg-white p-3">


        <div class="text-center">
            <h2>{{ $data->page_title }}</h2>
            <div class="text-muted">
                Path: {{ $data->path }}
            </div>
        </div>


        <form action="{{ URL('updateCustomPageData') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <div id="summernote" name="about"></div> --}}
            <input type="hidden" name="path" value="{{ $data->path }}" id="">
            <input type="hidden" name="type" value="{{ $data->type }}" id="">

            <textarea class="form-control summernote" name="data" placeholder=""> {{ $data->data }} </textarea>

            {{-- @if ($data->type == 'page' || $data->type == 'useful_links') --}}
                <div class="mb-3">
                    <label for="meta_title">Title</label>
                    <input type="text" class="form-control" name="page_title" value="{{ $data->page_title }}"
                        id="">
                </div>

                <div class="mb-3">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" value="{{ $data->meta_title }}"
                        id="">
                </div>
                <div class="mb-3">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" name="meta_description" value="{{ $data->meta_description }}"
                        id="">
                </div>
            {{-- @endif --}}
            <button class="btn btn-primary">Save</button>
        </form>
    </div>


    <script>
        $('.summernote').summernote({
            placeholder: 'write here',
            tabsize: 2,
            height: 500
        });
    </script>
@endsection
