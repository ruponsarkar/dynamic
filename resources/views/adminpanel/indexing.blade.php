@extends('adminpanel/layout')

@section('title', 'indexing')
@section('breadcrumb', 'indexing')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="addIndexing" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
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


                                <form action="{{url('addIndexing')}}" method="post" enctype="multipart/form-data">
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


                <a class="btn btn-primary" data-bs-toggle="modal" href="#addIndexing" role="button">Add Indexing</a>

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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered  table-hover small">
                            <thead>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Link</th>
                                    <th>Indexing</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($indexing->reverse() as $data)
                                <tr>
                                    <td>{{ $loop->index+1}}</td>
                                    <td> <a href="{{$data->link}}"> {{$data->link}}</a></td>
                                    <td class="text-center">
                                        <img src="{{url('assets/indexing/img/'.$data->img)}}" alt="No Image" width="200">
                                    </td>
                                    <td class="text-center">

                                        <a data-bs-toggle="modal" href="#editIndexing{{$data->id}}" role="button">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">

                                        <a class="confirmation" href="{{url('DeleteIndexing/'.$data->id)}}">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a>
                                    </td>
                                </tr>


                                <!-- modal for update indexing  -->
                                <div class="modal fade" id="editIndexing{{$data->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Update
                                                    Indexing</h1>
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


                                                <form action="{{url('UpdateIndexing')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    <div class="one">
                                                        <label for="language">For journal</label>
                                                        <select name="journal" class="form-control" id="">
                                                            @if (count($journals) > 0)
                                                            <option value="{{$journals[0]->j_id}}">{{$journals[0]->j_name}}</option>
                                                            @else 
                                                            <option value="no data" disabled></option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="one">
                                                        <label for="jname">Index link </label>
                                                        <input type="text" value="{{$data->link}}" class="form-control" name="link" id="">
                                                    </div>

                                                    <a class="form-control btn btn-warning btn-sm mt-2" data-bs-toggle="modal" href="#updateImage{{$data->id}}" role="button">Change Image</a>



                                                    <!-- <div class="one">
                                                        <label for="photo">Indexing Photo</label>
                                                        <input type="file" value="{{url('assets/img/indexing/'.$data->img)}}" class="form-control" name="photo" id="">
                                                    </div> -->

                                                    <div class="one p-2">
                                                        <input type="submit" class="btn btn-success" name="add-indexing" value="Save" id="">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal  -->


                                <!-- modal for Image Chamge  -->
                                <div class="modal fade" id="updateImage{{$data->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Update
                                                    Indexing</h1>
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


                                                <form action="{{url('UpdateIndexing')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$data->id}}">

                                                    <div class="one">
                                                        <label for="photo">Indexing Photo</label>
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
                                <!-- end modal  -->



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