@extends('adminpanel/layout')

@section('title', 'indexing')
@section('breadcrumb', 'indexing')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">





                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Add Indexing</h1>
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


                                <form action="addIndexing" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="one">
                                        <label for="language">For journal</label>
                                        <select name="journal" class="form-control" id="">
                                            @foreach($journals as $data)
                                            <option value="{{$data->j_id}}">{{$data->j_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="one">
                                        <label for="jname">Index link</label>
                                        <input type="text" class="form-control" name="link" id="">
                                    </div>

                                    <div class="one">
                                        <label for="photo">Cover Photo</label>
                                        <input type="file" class="form-control" name="photo" id="">
                                    </div>

                                    <div class="one p-2">
                                        <input type="submit" class="btn btn-success" name="add-indexing" value="Save" id="">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add Indexing</a>

            </div>
            <br>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center"> Click On Journal For Indexing </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered  table-hover small">
                            <thead>
                                <tr class="text-center">
                                    <th>Sl No.</th>
                                    <th>JournalName</th>
                                    <th>Go For Indexing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter = 1;
                                @endphp

                                @foreach($journals as $data)
                                <tr>
                                    <td class="text-center">{{$counter++}}</td>
                                    <td>

                                        <!-- {{$data->link}}  -->
                                        {{$data->j_name}}
                                    </td>
                                    <td class="text-center">

                                        <a href="{{url('indexingList/'.$data->j_id)}}">
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
</section>

@endsection