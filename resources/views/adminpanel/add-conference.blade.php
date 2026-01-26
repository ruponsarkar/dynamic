@extends('adminpanel/layout')
@section('title', 'Dashboard')
@section('content')

<?php
// dd($confrence)
?>
<div class="container-form card p-1 p-md-3 p-lg-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="p-3">Add Conference Proceedings</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Conference Proceedings
        </button>
    </div>
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-body">
                    <form action="{{ URL('addConferences')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="one form-group">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>

                        <div class="one form-group d-block ">
                            <label class="form-label" for="name">Upload File </label>
                            <input type="file" name="file" id="" class="form-control">
                        </div>
                        <div class="one mt-lg-3 text-center">
                            <input class="btn btn-block btn-primary w-50 m-auto" type="submit" name="submit-article" value="Save" id="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="volume-list col-md-12 col-md-8 col-11 m-auto">

        <table class="table">
            <thead>
                <tr>
                    <th>sl no</th>
                    <th>Title</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($confrence as $item )
                <tr>
                    <td>  {{ $loop->index + 1 }} </td>
                    <td>{{$item->title}}</td>
                    <td> <a href="../assets/conference/{{$item->file}}">View file</a> </td>
                    <td>
                        <a href="{{ URL('update-conference/' . $item->id) }}" class="btn btn-sm btn-success">edit</a>
                        <a href="{{URL('delete-conference/' . $item->id)}}" class="btn btn-sm btn-danger">delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>






@endsection