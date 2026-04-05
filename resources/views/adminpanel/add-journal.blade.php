@extends('adminpanel/layout')

@section('title', 'Home')
@section('breadcrumb', 'Add Journals')


@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">





        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Add Journals</h1>
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
                    <li>{{ $e }}</li>
                    @endforeach
                  </ul>
                </div>


                <form action="addJournal" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Journal Name:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="jname" required="required" placeholder="Journal Name">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Abbr. Title:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="abbr" required="required" placeholder="Abbr. Title">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">ISSN:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="issn" required="required" placeholder="ISSN">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Frequency</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="frequency" required="required" placeholder="Frequency">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Subject</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="subject" required="required" placeholder="Subject">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Format</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="formatOfJournal" required="required" placeholder="Format">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Starting year</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="starting_year" required="required" placeholder="Starting year">
                    </div>
                  </div>


                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Language:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="language" required="required" placeholder="Language">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Chief Editor:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="chief" required="required" placeholder="Chief Editor">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Publisher:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="publisher" required="required" placeholder="Publisher">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Country Of Origin:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="country" required="required" placeholder="Country Of Origin">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Aim And Scope:</label>
                    <div class="col-sm-8">
                      <input type="textarea" class="form-control" name="aim" required="required" placeholder="Aim And Scope">
                    </div>
                  </div>
                  <div class="form-group row p-1">
                    <label class="col-sm-4 col-form-label">Cover Photo:</label>
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
        <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add Journals</a>

      </div>
      <br>
      <br>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center"> All Manuscript </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered  table-hover small">
              <thead>
                <tr class="text-center">
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>Abbr Title</th>
                  <th>ISSN</th>
                  <th>Chief Editors</th>

                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

                @php
                $counter = 1;
                @endphp

                @foreach($journal as $data)
                <tr>
                  <td class="text-center">{{$counter++}}</td>
                  <td>{{$data->j_name}}</td>
                  <td>{{$data->abbr_title}}</td>
                  <td>{{$data->issn}}</td>
                  <td>{{$data->chief_editor}}</td>

                  <!-- <td><a href="update-editors/{{$data->id}}">Edit</a></td> -->

                  <td class="text-center"><a href="{{URL('update-journals/'.$data->j_id)}}"><i class="far fa-edit"></i></a></td>

                  <td class="text-center"><a class="confirmation" href="{{URL('delete-journals/'.$data->j_id)}}"><i class="fas fa-trash-alt text-danger"></i></a></td>

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