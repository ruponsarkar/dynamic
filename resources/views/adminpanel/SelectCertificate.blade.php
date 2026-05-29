@extends('adminpanel/layout')

@section('title', 'certificate')
@section('breadcrumb', 'certificate')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary" data-bs-toggle="modal" href="#addCertificate" role="button">Add Certificate</a>
            </div>
            <br>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Click On Journal For Certificates</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover small">
                            <thead>
                                <tr class="text-center">
                                    <th>Sl No.</th>
                                    <th>Journal Name</th>
                                    <th>Go For Certificates</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach($journals as $data)
                                <tr>
                                    <td class="text-center">{{ $counter++ }}</td>
                                    <td>{{ $data->j_name }}</td>
                                    <td class="text-center">
                                        <a href="{{url('certificateList/'.$data->j_id)}}">
                                            <i class="fas fa-arrow-circle-right"></i>
                                        </a>
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

                    <form action="{{ url('addCertificate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="one">
                            <label for="language">For journal</label>
                            <select name="journal" class="form-control">
                                @foreach($journals as $data)
                                <option value="{{ $data->j_id }}">{{ $data->j_name }}</option>
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
</section>
@endsection
