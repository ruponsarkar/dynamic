@extends('adminpanel/layout')

@section('title', 'Home')
@section('breadcrumb', 'Add Volume')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Add News</h1>
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

                                <form action="addnews" method="post" enctype="multipart/form-data" id="newsForm">
                                    @csrf
                                    <div class="one">
                                        <label for="name">News Name</label>
                                        <input type="text" name="title" id="newsTitle" class="form-control">
                                    </div>

                                    <div class="one" style="padding : 20px">
                                        <input type="hidden" name="news_id" id="newsId">
                                        <input class="btn btn-block btn-primary" type="submit" name="submit-volume" value="Save" id="submitBtn">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add Volume</a>

            </div>
            <br>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center"> All News </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered  table-hover small">
                            <thead>
                                <tr class="text-center">
                                    <th>Sl No.</th>
                                    <th>News Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach($news as $data)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>
                                        <div class="list-v">
                                            {{$data->title}}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="edit-btn" data-id="{{$data->id}}" data-title="{{$data->title}}">
                                            <i class="fas fa-pencil"></i> edit
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

@section('script2')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const exampleModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const newsId = this.getAttribute('data-id');
                const newsTitle = this.getAttribute('data-title');

                document.getElementById('newsId').value = newsId;
                document.getElementById('newsTitle').value = newsTitle;
                document.getElementById('exampleModalToggleLabel').textContent = 'Edit News';
                document.getElementById('submitBtn').value = 'Update';

                exampleModal.show();
            });
        });

        document.querySelector('.btn-primary[data-bs-toggle="modal"]').addEventListener('click', function() {
            document.getElementById('newsForm').reset();
            document.getElementById('newsId').value = '';
            document.getElementById('exampleModalToggleLabel').textContent = 'Add News';
            document.getElementById('submitBtn').value = 'Save';
        });
    });
</script>

@endsection