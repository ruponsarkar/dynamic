@extends('adminpanel/custom_pages/cus_layout')

@section('customPage')
    <div class="bg-white p-3">


        <div class="text-center">
            <h2>Add new Page/Content</h2>

        </div>


        <form action="{{ URL('addCustomPageData') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <div id="summernote" name="about"></div> --}}
            <div class="mb-3">
                <label for="path">Path</label>
                <input type="text" class="form-control" name="path" id="">
            </div>

            <div class="mb-3">
                <label for="type">Type</label>
                <select name="type" id="" required class="form-select">
                    <option value="page">Page</option>
                    <option value="content">Content</option>
                </select>
            </div>


            <div class="mb-3">

                <textarea class="form-control summernote" name="data" placeholder=""> </textarea>
            </div>


            <div class="mb-3">
                <label for="meta_title">Page Title</label>
                <input type="text" class="form-control" name="page_title" id="">
            </div>

            <div class="mb-3">
                <label for="meta_title">Meta Title</label>
                <input type="text" class="form-control" name="meta_title" id="">
            </div>
            <div class="mb-3">
                <label for="meta_description">Meta Description</label>
                <input type="text" class="form-control" name="meta_description" id="">
            </div>

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
