@extends('adminpanel/pages/setPages')

@section('setPage')
    <div class="text-center">
        <h2>{{$type}}</h2>
    </div>


    <form action="{{ URL('savePageData') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <div id="summernote" name="about"></div> --}}
        <input type="hidden" name="type" value="{{$type}}" id="">
        <textarea class="form-control summernote" name="data" placeholder="" > {{$data->data}} </textarea>
        <button class="btn btn-primary">Save</button>
    </form>

    <script>
      $('.summernote').summernote({
        placeholder: 'write here',
        tabsize: 2,
        height: 500
      });
    </script>
@endsection
