@extends('adminpanel/layout')

@section('title', 'Home')
@section('breadcrumb', 'Add Volume')


@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Add Volume</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif

                                    <div class="error_msg">
                                        <ul>
                                            @foreach ($errors->all() as $e)
                                                <li>{{ $e }}</li>
                                            @endforeach
                                        </ul>
                                    </div>



                                    <form action="addVolume" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="one">
                                            <label for="name">Volume Name</label>
                                            <input type="text" name="name" id="" class="form-control">
                                        </div>

                                        <div class="one">
                                            <label for="name">Year</label>
                                            <input type="year" name="year" id="" class="form-control">
                                        </div>

                                        <div class="one">
                                            <label for="language">For journal</label>
                                            <select name="journal" id="" class="form-select">
                                                @foreach ($journal as $data)
                                                    <option value="{{ $data->j_id }}">{{ $data->j_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="one" style="padding : 20px">

                                            <input class="btn btn-block btn-primary" type="submit" name="submit-volume"
                                                value="Save" id="">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add
                        Volume</a>

                </div>
                <br>
                <br>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center"> All Volume </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered  table-hover small">
                                <thead>
                                    <tr class="text-center">
                                        <th>Sl No.</th>
                                        <th>Journal</th>
                                        <th>Volume Name</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($volume as $data)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>

                                                {{ $data->j_name }}
                                             </td>
                                            <td>

                                                <div class="list-v">
                                                    <b> {{ $data->name }} </b>

                                                    {{-- ({{ $data->j_name }}) --}}
                                                </div>
                                            </td>
                                            <td>

                                               {{ $data->year }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ URL('add-issues/' . $data->id) }}">
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
