@extends('adminpanel/layout')

@section('title', 'Home')
@section('breadcrumb', 'Add Editors')


@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">





        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Add Editors</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @if(session()->has('message'))
                <div class="alert alert-success">
                  {{ session()->get('message') }}
                </div>
                @endif

                <div class="error_msg">
                  <ul>
                    @foreach($errors->all() as $e)

                    <li>
                      <div class="alert alert-danger">{{ $e }} </div>
                    </li>
                    @endforeach
                  </ul>
                </div>

                <form action="editors" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Editors Name:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="name" required="required" placeholder="Editors Name">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Designation :</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="designation" required="required" placeholder="Designation">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">University:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="university" required="required" placeholder="University">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Details (*Optional):</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="details" required="required" placeholder="Details (*Optional)">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Type</label>
                    <div class="col-sm-8">
                    <select name="type" class="form-select" aria-label="Default select example">
                    <option></option>
                    <option value="ass">Associative</option>
                    <option value="chief">Chief</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">For journal</label>
                    <div class="col-sm-8">
                    <select name="journal" class="form-select" aria-label="Default select example">
                    <option></option>
                    @foreach($journal as $data)
                      <option value="{{$data->j_id}}">{{$data->j_name}}</option>

                      @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Profile Link:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="profile" required="required" placeholder="Profile Link">
                    </div>
                  </div>
                  
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Photo:</label>
                    <div class="col-sm-8">
                    <input class="form-control" type="file"  name="photo" accept=".jpg,.jpeg,.png" id="formFile">
                    </div>
                  </div>

                  <div class="form-group row p-1">
                    <div class="col-sm-12">
                    <div class="d-grid gap-2">

                      <input type="submit" name="submit-journals" value="Save" id="" class="btn btn-block btn-success">
                    </div>
                    </div>
                  </div>





                </form>


              </div>
            </div>
          </div>
        </div>

        <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add Editors</a>

        </div>
            <br>
            <br>



        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center"> Editors </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example2" class="table table-bordered  table-hover small">
                <thead>
                  <tr class="text-center">
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>University</th>
                    <th>Details</th>
                    <th>Type</th>
                    <th>Photo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                <tbody>
                  @php
                  $counter = 1;
                  @endphp
                  @foreach($editors as $data)
                  <tr>
                    <td class="text-center">{{$counter++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->university}}</td>
                    <td>{{$data->details}}</td>
                    <td>{{$data->type}}</td>
                    <td><a href="../assets/all-editors/{{$data->image}}">{{$data->image}}</a></td>
                    <!-- <td><a href="update-editors/{{$data->id}}">Edit</a></td> -->

                    <td class="text-center"><a href="edit_editor/{{$data->id}}"><i class="far fa-edit"></i></a></td>

                    <td class="text-center"><a class="confirmation" href="delete_editors/{{$data->id}}"><i class="fas fa-trash-alt text-danger"></i></a></td>

                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>




@endsection