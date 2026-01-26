@extends('adminpanel/layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')



@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">

            <h3>Edit conference {{$conference->title}}</h3>
            <form action="update-conference-data/{{$conference->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex-outer">
                    <div>
                        <label for="first-name" class="form-label">Title</label>
                        <input type="text" id="name" name="title" value="{{$conference->title}}" class="form-control">
                    </div>
                    <div>
                        <label for="phone" class="form-label">Change File</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div>
                        <input type="hidden" name="id" value="{{$conference->id}}">
                    </div>
                    <div class="text-center m-auto m-4" style="padding : 20px">
                        <button class="btn btn-primary " type="submit" name="submit">Update Details</button>
                    </div>
            </form>
        </div>
    </div>
</div>


@endsection