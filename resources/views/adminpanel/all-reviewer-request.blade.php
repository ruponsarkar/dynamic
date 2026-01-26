@extends('adminpanel/layout')

@section('title', 'All Manuscript')
@section('breadcrumb', 'All Manuscript')


@section('content')


<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center"> All Reviewer Request </h3>
          </div>

          <div class="card-body">
            <table id="example2" class="table table-bordered  table-hover small">
              <thead>
                <tr>
                  <th>CV</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Country</th>
                  <th>Specialization</th>
                  <th>Affiliation</th>
                  <th>publication</th>
                  <th>Photo</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($reviewer as $data)
                <tr>



                  <td style="text-align: center; color:red; font-weight:bold;"><a href="{{URL('assets/reviewers/cv/'.$data->cv)}}" target="_blank"> Check CV
                    </a></td>

                  <td>{{$data->name}}</td>
                  <td>{{$data->email}}</td>
                  <td>{{$data->mobile}}</td>
                  <td>{{$data->country}}</td>
                  <td>{{$data->specialization}}</td>
                  <td>{{$data->affiliation}}</td>
                  <td>{{$data->publication}}</td>
                  <td>
                    <center> <img src="{{URL('assets/reviewers/img/'.$data->photo)}}" alt="" width='100'> <br>Photo </center>
                  </td>
                  <td>{{$data->date}}</td>
                  <td class="text-center"><a href="{{URL('update-journals/'.$data->j_id)}}"><i class="far fa-edit"></i></a>
                  <a class="confirmation" href="{{URL('delete-journals/'.$data->j_id)}}"><i class="fas fa-trash-alt text-danger"></i></a>
                </td>
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