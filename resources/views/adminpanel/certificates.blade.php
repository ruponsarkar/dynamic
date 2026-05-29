@extends('adminpanel/layout')

@section('title', 'certificate')
@section('breadcrumb', 'certificate')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="addCertificate" aria-hidden="true" aria-labelledby="addCertificateLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addCertificateLabel">Add Certificate</h1>
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

                                <form action="{{url('addCertificate')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="one">
                                        <label for="language">For journal</label>
                                        <select name="journal" class="form-control">
                                            @foreach($journals as $data)
                                            <option value="{{$data->j_id}}">{{$data->j_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="one mt-2">
                                        <label for="title">Title (Optional)</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="one mt-2">
                                        <label for="photo">Certificate Image</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    <div class="one p-2">
                                        <input type="submit" class="btn btn-success" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn btn-primary" data-bs-toggle="modal" href="#addCertificate" role="button">Add Certificate</a>
            </div>
            <br>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (count($journals) > 0)
                        <h3 class="card-title text-center">{{ $journals[0]->j_name }}</h3>
                        @else
                        <h3 class="card-title text-center">No journals found</h3>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover small">
                            <thead>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Certificate</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certificates->reverse() as $data)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $data->title ?: 'N/A' }}</td>
                                    <td class="text-center">
                                        <img src="{{url('assets/certificates/img/'.$data->img)}}" alt="No Image" width="200">
                                    </td>
                                    <td class="text-center">
                                        <a data-bs-toggle="modal" href="#editCertificate{{$data->id}}" role="button">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="confirmation" href="{{url('DeleteCertificate/'.$data->id)}}">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editCertificate{{$data->id}}" aria-hidden="true" aria-labelledby="editCertificateLabel{{$data->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editCertificateLabel{{$data->id}}">Update Certificate</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('UpdateCertificate')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    <div class="one">
                                                        <label for="title">Title (Optional)</label>
                                                        <input type="text" value="{{$data->title}}" class="form-control" name="title">
                                                    </div>
                                                    <div class="one p-2">
                                                        <input type="submit" class="btn btn-success" value="Save Title">
                                                    </div>
                                                </form>

                                                <form action="{{url('UpdateCertificate')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    <div class="one mt-2">
                                                        <label for="photo">Certificate Image</label>
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>
                                                    <div class="one p-2">
                                                        <input type="submit" class="btn btn-success" value="Change Image">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
