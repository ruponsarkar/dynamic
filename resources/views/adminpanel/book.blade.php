
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>
   
    
    @include('adminpanel.admin_partial.dash-link')
</head>
<body>
@include('adminpanel.admin_partial.dash-sidebar')

<div class="container-form">
    <h1>Add Books</h1>

    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div class="error_msg">
  <ul>
    @foreach($errors->all() as $e)
    <li>{{ $e }}</li>
    @endforeach
  </ul>
</div>

<form action="{{URL ('addBook')}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="one">
<label for="jname">Title</label>
<input type="text" name="title" id="">
</div>

<div class="one">
<label for="abbr">Editors</label>
<input type="text" name="editors" id="">
</div>


<div class="one" style="height: auto;">
<label for="Scopes">Scopes</label>
<textarea id="" name="scopes" placeholder="scopes.." style="height:100px"></textarea>
</div>

<div class="one">
<label for="photo">Cover Photo</label>
<input type="file" name="photo" id="">
</div>

<div class="one">

<input type="submit" name="submit-book" value="Save" id="">
</div>
</form>

</div>



<table class="table table-striped table-bordered" cellspacing="0" width="100%">
  <tr style="background-color: deeppink;">
    <th>Title</th>
    <th>Editors</th>
    <th>Scopes</th>
    
    <th>Edit</th>
    <th>Delete</th>
  </tr>

@foreach($books as $data)
  <tr>
    <td>{{$data->title}}</td>
    <td>{{$data->editors}}</td>
    <td>{{$data->scopes}}</td>

    <!-- <td><a href="update-editors/{{$data->id}}">Edit</a></td> -->

    <td><a class="btn btn-success" href="editBook/{{$data->id}}">Edit(Not working)</a></td>
    
    <td><a class="btn btn-danger" href="deleteBook/{{$data->id}}">Delete(Not working)</a></td>
  
  </tr>





@endforeach
</table>






@include('adminpanel.admin_partial.dash-bottom')
</body>
</html>