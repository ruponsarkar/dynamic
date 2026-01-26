@extends('adminpanel/layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


@section('content')

<div>
  
</div>

<div class="container">

  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif

  <div class="error_msg">
    <ul>
      @foreach($errors->all() as $e)
      <div>{{ $e }}</div>
      @endforeach
    </ul>
  </div>

  <form method="POST" action="{{URL('updateJournalsData/'.$journal->j_id)}}">
    @csrf
    <ul class="flex-outer">
      <div class="pb-3"> 
        <label for="first-name">Journal Name</label>
        <input type="text" class="form-control" id="name" name="jname" value="{{$journal->j_name}}">
      </div>
      <div class="pb-3">
        <label for="last-name">Abbr. title</label>
        <input type="text" class="form-control" id="university" name="abbr" value="{{$journal->abbr_title}}">
      </div>
      <div class="pb-3">
        <label for="last-name">ISSN</label>
        <input type="text" class="form-control" id="university" name="issn" value="{{$journal->issn}}">
      </div>
      <div class="pb-3">
        <label for="email">Frequency</label>
        <input type="text" class="form-control" id="details" name="frequency" value="{{$journal->frequency}}">
      </div>
      <div class="pb-3">
        <label for="phone">Language</label>
        <input type="text" class="form-control" id="type" name="language" value="{{$journal->language}}">
      </div>

      <div class="pb-3">
        <label for="phone">Chief Editor</label>
        <input type="text" class="form-control" id="type" name="chief" value="{{$journal->chief_editor}}">
      </div>

      <div class="pb-3">
        <label for="phone">Publisher</label>
        <input type="text" class="form-control" id="type" name="publisher" value="{{$journal->publisher}}">
      </div>

      <div class="pb-3">
        <label for="phone">Country of Origin</label>
        <input type="text" class="form-control" id="type" name="country" value="{{$journal->country_of_origin}}">
      </div>

      <div class="pb-3">
        <label for="phone">Aim and Scope</label>

        {{-- <textarea name="aim" id="aim" cols="30" rows="20">{{$journal->aim_and_scope}}</textarea> --}}
        <textarea class="form-control summernote" name="aim" placeholder=""> {{$journal->aim_and_scope}}</textarea>

      </div>


      <div class="pb-3">

        <input type="hidden" name="id" value="{{$journal->j_id}}">

      <div class="pb-3">
        <button type="submit" class="btn btn-primary" name="submit">Update Details</button>
      </div>
    </ul>
  </form>

  <br><br><br><br><br><br><br><br>

  <form action="{{URL('updateJournalPhoto/'.$journal->j_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <ul class="flex-outer">
      <div>
        <label for="phone">Change image</label>
        <input type="file" name="photo">
        <button type="submit" class="btn btn-primary" name="img-change">Change Image</button>
      </div>
    </ul>
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