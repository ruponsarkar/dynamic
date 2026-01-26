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
<style>
  .flex-outer li,
  .flex-inner {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }

  .flex-inner {
    padding: 0 8px;
    justify-content: space-between;
  }

  .flex-outer>li:not(:last-child) {
    margin-bottom: 20px;
  }

  .flex-outer li label,
  .flex-outer li p {
    padding: 8px;
    font-weight: 300;
    letter-spacing: .09em;
    text-transform: uppercase;
  }

  .flex-outer>li>label,
  .flex-outer li p {
    flex: 1 0 120px;
    max-width: 220px;
  }

  .flex-outer>li>label+*,
  .flex-inner {
    flex: 1 0 220px;
  }

  .flex-outer li p {
    margin: 0;
  }

  .flex-outer li input:not([type='checkbox']),
  .flex-outer li textarea,
  select {
    padding: 15px;
    border: none;
  }

  .flex-outer li button {
    margin-left: auto;
    padding: 8px 16px;
    border: none;
    background: #333;
    color: #f2f2f2;
    text-transform: uppercase;
    letter-spacing: .09em;
    border-radius: 2px;
  }

  .flex-inner li {
    width: 100px;
  }
</style>


<div class="container">

  <form  action="update-article-data/{{$articles->id}}"  method="post" enctype="multipart/form-data">
  @csrf
    <ul class="flex-outer">
      <li>
        <label for="first-name">Corresponding Article </label>
        <input type="text" id="name" name="name" value="{{$articles->name}}">
      </li>
      <li>
        <label for="last-name">Author Name</label>
        <input type="text" id="aname" name="aname" value="{{$articles->aname}}">
      </li>
      <li>
        <label for="email">Author Designation</label>
        <input type="text" id="designation" name="designation" value="{{$articles->designation}}">
      </li>
      
      <li>
        <label class="form-label" for="name">Published</label>
        <input type="text" name="published_date" id="published_date" value="{{$articles->published_date}}">
      </li>
      
      <li>
          <label class="form-label" for="name">GoogleScholar link</label>
          <input type="text" name="googleScholar" id="googleScholar" value="{{$articles->googleScholar}}">
      </li>
      {{-- <li>
        <label class="form-label" for="name">Keywords</label>
        <input type="text" name="keywords" id="" value="{{$articles->keywords}}">
      </li> --}}


      <li>
        <label for="email">DOI</label>
        <input type="text" id="doi" name="doi" value="{{$articles->doi}}">
      </li>

      <li>
        <label for="email">Page No</label>
        <input type="text" id="page" name="page" value="{{$articles->page}}">
      </li>
      
      {{-- ************************** --}}
      
      <li>
        <label for="email">SL No</label>
        <input type="text" id="sr_no" name="sr_no" value="{{$articles->sr_no}}">
      </li>
      <li>
        <label for="email">Cited by</label>
        <input type="text" id="cited_by" name="cited_by" value="{{$articles->cited_by}}">
      </li>
      <li>
        <label for="email">language </label>
        <input type="text" id="language" name="language" value="{{$articles->language}}">
      </li>
      <li>
        <label for="email">licence </label>
        <input type="text" id="licence" name="licence" value="{{$articles->licence}}">
      </li>
      <li>
        <label for="email">received </label>
        <input type="text" id="received" name="received" value="{{$articles->received}}">
      </li>
      <li>
        <label for="email">revised </label>
        <input type="text" id="revised" name="revised" value="{{$articles->revised}}">
      </li>
      <li>
        <label for="email">accepted </label>
        <input type="text" id="accepted" name="accepted" value="{{$articles->accepted}}">
      </li>
      <li>
        <label for="email">keywords </label>
        <input type="text" id="keywords" name="keywords" value="{{$articles->keywords}}">
      </li>
      <li>
        <label for="email">abstract </label>
        {{-- <textarea name="abstract" id="" cols="30" rows="10" class="form-control">{{$articles->abstract}}</textarea> --}}
        <textarea class="form-control summernote" name="abstract" placeholder=""> {{$articles->abstract}} </textarea>
      </li>
      


      {{-- ******************************** --}}




      <li>
        <label for="phone">Change File</label>
        <input type="file" name="file">
        <!-- <input type="hidden" name="id" value="{{$articles->id}}"> -->
        <!-- <button type="submit" name="img-file">Change Image</button> -->
      </li>

      <li>

        <input type="hidden" name="id" value="{{$articles->id}}">

      <li>
        <button type="submit" name="submit">Update Details</button>
      </li>
    </ul>
  </form>

  <br><br><br><br><br>

  <form action="update-article-data.php" method="post" enctype="multipart/form-data">
    <ul class="flex-outer">
     
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