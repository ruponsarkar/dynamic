@extends('adminpanel/layout')
@section('title', 'Dashboard')
@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <div class="container-form card p-1 p-md-3 p-lg-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="p-3">Add Article</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Article
            </button>
        </div>
        <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-body">
                        <form action="{{ URL('addArticleData/' . $id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row p-3">
                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Sr No</label>
                                    <input type="text" name="sr_no" id="sr_no" class="form-control">
                                </div>

                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Published date</label>
                                    <input type="date" name="published_date" id="published_date" class="form-control">
                                </div>

                                <div class="col-md-12 pt-4">
                                    <label for="name" class="form-label">Article Name</label>
                                    <input type="text" name="name" id="" class="form-control">
                                </div>


                                <div class="col-md-12 pt-4">
                                    <label class="form-label" for="name">Corresponding Author</label>
                                    <input type="text" name="aname" id="" class="form-control">
                                </div>


                                <div class="col-md-12 pt-4">
                                    <label class="form-label" for="name">Author Designation</label>
                                    <input type="text" name="designation" id="" class="form-control">
                                </div>
                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Email</label>
                                    <input type="text" name="email" id="" class="form-control">
                                </div>

                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Article Type</label>
                                    <select name="article_type" id="article_type" class="form-control">
                                        <option value="">Select Article Type</option>
                                        <option value="Research Article">Research Article</option>
                                        <option value="Review Article">Review Article</option>
                                        <option value="Case Study">Case Study</option>
                                        <option value="Short Communication">Short Communication</option>
                                        <option value="Letter to the Editor">Letter to the Editor</option>
                                        <option value="Editorial">Editorial</option>
                                        <option value="Conference Paper">Conference Paper</option>
                                        <option value="Book Review">Book Review</option>
                                        <option value="Case Presentation">Case Presentation</option>
                                        <option value="Case Report">Case Report</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>


                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">GoogleScholar link</label>
                                    <input type="text" name="googleScholar" id="googleScholar" class="form-control">
                                </div>

                                {{-- ************* --}}


                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Cited By</label>
                                    <input type="text" name="cited_by" id="cited_by" class="form-control">
                                </div>
                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Language</label>
                                    <input type="text" name="language" id="language" class="form-control">
                                </div>
                                {{-- <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Licence</label>
                                    <input type="text" name="licence" id="licence" class="form-control">
                                </div> --}}

                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Received</label>
                                    <input type="date" name="received" id="received" class="form-control">
                                </div>
                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Revised</label>
                                    <input type="date" name="revised" id="revised" class="form-control">
                                </div>
                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Accepted</label>
                                    <input type="date" name="accepted" id="accepted" class="form-control">
                                </div>



                                {{-- ************* --}}


                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">DOI</label>
                                    <input type="text" name="doi" id="doi" class="form-control">
                                </div>
                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">DOI Link</label>
                                    <input type="text" name="doi_link" id="doi_link" class="form-control">
                                </div>

                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Page No</label>
                                    <input type="text" name="page" id="page" class="form-control">
                                </div>
                                <div class="col-md-6 pt-4">
                                    <label class="form-label" for="name">Orcid-id</label>
                                    <input type="text" name="orcid_id" id="orcid_id" class="form-control">
                                </div>

                                <div class="col-md-12 pt-4">
                                    <label class="form-label" for="name">Keywords</label>
                                    <input type="text" name="keywords" id="keywords" class="form-control">
                                </div>

                                <div class="one pt-4">
                                    <label class="form-label" for="name">Abstract</label>
                                    {{-- <textarea name="abstract" id="" cols="30" rows="10" class="form-control"></textarea> --}}
                                    <textarea class="form-control summernote" name="abstract" placeholder=""> </textarea>
                                    {{-- <input type="text" name="designation" id=""> --}}
                                </div>



                                <div class="one pt-4 form-group d-block ">
                                    <label class="form-label" for="name">File</label>
                                    <input type="file" name="file" id="" class="form-control">
                                </div>
                                <div class="one mt-lg-3 text-center">
                                    <input class="btn btn-block btn-primary w-50 m-auto" type="submit"
                                        name="submit-article" value="Save" id="">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- @if (session()->has('message'))
    <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
    @endif -->

        <!-- <div class="error_msg">
                <ul>
                    @foreach ($errors->all() as $e)
    <li class="alert alert-success">{{ $e }}</li>
    @endforeach
                </ul>
            </div> -->




        <div class="volume-list col-md-12 col-md-8 col-11 m-auto">

            <table class="table">
                <thead>
                    <tr>
                        <th>sl no</th>
                        <th>Title</th>
                        <th>Corresponding Author</th>
                        <th>Author Designation</th>
                        <th>DOI</th>
                        <th>Page No</th>
                        {{-- <th>Abstract</th> --}}
                        <th>Document</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // dd($article)
                    ?>
                    @foreach ($article as $data)
                        <?php
                        // dd($data)
                        ?>
                        <tr>
                            <td scope="row"> {{ $loop->index + 1 }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->aname }}</td>
                            <td>{{ $data->designation }}</td>
                            <td>{{ $data->doi }}</td>
                            <td>{{ $data->page }}</td>
                            {{-- <td>{{ $data->abstract }}</td> --}}
                            <!-- <td><a href="../assets/all-editors/{{ $data->image }}">{{ $data->image }}</a></td> -->
                            <td>
                                <a href="../assets/editors/cv/{{ $data->file }}">
                                    {{ $data->file }}</a>
                            </td>
                            <td>
                                <a href="{{ URL('update-article/' . $data->id) }}"
                                    class="btn btn-sm btn-success w-100 ms-auto">Edit</a>
                                <a href="{{ URL('delete-article/' . $data->id) }}"
                                    class="btn btn-sm btn-danger w-100 ms-auto">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




    <script>
        $('.summernote').summernote({
            placeholder: 'write here',
            tabsize: 2,
            height: 500
        });
    </script>

@endsection
