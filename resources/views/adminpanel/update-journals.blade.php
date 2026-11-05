@extends('adminpanel/layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
@endsection

@section('script2')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
  $(function () {
    $('#journal-aim').summernote({
      placeholder: 'Describe the journal’s aims, subject areas, and scope…',
      height: 260,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
        ['view', ['codeview']]
      ]
    });
  });
</script>
@endsection

@section('content')

<div>
  
</div>

<div class="container">

  <header class="admin-page-heading">
    <span>JOURNALS / EDIT</span>
    <h1>Edit journal profile</h1>
    <p>Update publication details and the journal cover image.</p>
  </header>

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
    <h2 class="admin-form-title">Publication details</h2>
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
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" value="{{$journal->subject}}">
      </div>
      <div class="pb-3">
        <label for="format">Format</label>
        <input type="text" class="form-control" id="format" name="format" value="{{$journal->format}}">
      </div>
      <div class="pb-3">
        <label for="starting_year">Starting Year</label>
        <input type="text" class="form-control" id="starting_year" name="starting_year" value="{{$journal->starting_year}}">
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

      <div class="pb-3 admin-journal-aim-field">
        <label for="journal-aim">Aim and Scope</label>
        <textarea id="journal-aim" class="form-control" name="aim">{{ old('aim', $journal->aim_and_scope) }}</textarea>
      </div>


      <div class="pb-3">

        <input type="hidden" name="id" value="{{$journal->j_id}}">

      <div class="pb-3">
        <button type="submit" class="btn btn-primary" name="submit">Update Details</button>
      </div>
    </ul>
  </form>

  <form action="{{URL('updateJournalPhoto/'.$journal->j_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <h2 class="admin-form-title">Journal cover</h2>
    <p class="admin-form-help">Choose a clear, high-resolution image for the journal listing.</p>
    <ul class="flex-outer">
      <div>
        <label for="phone">Change image</label>
        <input type="file" name="photo">
        <button type="submit" class="btn btn-primary" name="img-change">Change Image</button>
      </div>
    </ul>
  </form>



</div>



@endsection
