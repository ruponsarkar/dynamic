@extends('layouts.app')

@section('title', 'Manuscript')



@section('content')

<div>
    <!-- MAIN CONTENT GRID -->
    <div class="container mt-4">

       <div class="row">

           <!-- LEFT SECTION -->
           <div class="col-md-9">
            <div class="container-fluid">

                <div class="row manuscript-bg pb-3">
                    <div class=" manuscript-form pb-3 card-c cus-padding">
                        <div class="h3 fw-bold text-center p-3">Manuscript Submission</div>
        
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">
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
        
        
        
        
                        <form method="POST" action="{{ url('submit_manuscript') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="Select Mode" class="col-sm-4 col-form-label">Select Mode</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="specificSizeSelect" name="mode">
                                        <option value="">Select</option>
                                        <option value="Normal Mode" {{ old('mode') == 'Normal Mode' ? 'selected' : '' }}>Normal Mode</option>
                                        <option value="Fast Track Mode" {{ old('mode') == 'Fast Track Mode' ? 'selected' : '' }}>Fast Track Mode</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Article Type" class="col-sm-4 col-form-label">Article Type</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="specificSizeSelect" name="type">
                                        <option value="">Select</option>
                                        <option value="Research article" {{ old('type') == 'Research article' ? 'selected' : '' }}>Research article</option>
                                        <option value="Review article" {{ old('type') == 'Review article' ? 'selected' : '' }}>Review article</option>
                                        <option value="Short Communication" {{ old('type') == 'Short Communication' ? 'selected' : '' }}>Short Communication</option>
                                        <option value="Case Report" {{ old('type') == 'Case Report' ? 'selected' : '' }}>Case Report</option>
                                        <option value="Letter to editor" {{ old('type') == 'Letter to editor' ? 'selected' : '' }}>Letter to editor</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Select Journal" class="col-sm-4 col-form-label">Select Journal</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="specificSizeSelect" name="journal">
                                        <option value="">Select</option>
                                        @foreach ($journals as $data)
                                            <option value="{{ $data->j_id }}" {{ old('journal') == $data->j_id ? 'selected' : '' }}> {{ $data->j_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Corresponding Author" class="col-sm-4 col-form-label">Corresponding Author</label>
                                <div class="col-sm-8">
                                    <input type="text" name="author" class="form-control" placeholder="Full Name"
                                        value="{{ old('author', $author->name ?? '') }}">
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Full Affiliation" class="col-sm-4 col-form-label">Full Affiliation</label>
                                <div class="col-sm-8">
                                    <textarea type="text" name="affiliation" class="form-control" placeholder="Affiliation">{{ old('affiliation', $author->affiliation ?? '') }}</textarea>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="mail" class="form-control" placeholder="Email"
                                        value="{{ old('mail', $author->email ?? '') }}">
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="Email" class="col-sm-4 col-form-label">Orcid-id</label>
                                <div class="col-sm-8">
                                    <input type="text" name="orcid_id" class="form-control" placeholder="Orcid-id">
                                </div>
                            </div> --}}
        
                            <div class="row mb-3">
                                <label for="Mobile" class="col-sm-4 col-form-label">Mobile</label>
                                <div class="col-sm-8">
                                    <input type="text" name="mobile" class="form-control"
                                        placeholder="Mobile Number (Country code mandatory)"
                                        value="{{ old('mobile', $author->mobile ?? '') }}">
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Manuscript Title" class="col-sm-4 col-form-label">Manuscript Title</label>
                                <div class="col-sm-8">
                                    <input type="text" name="manuscript" class="form-control" placeholder="Manuscript Title"
                                        value="{{ old('manuscript') }}">
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Choose a file to upload" class="col-sm-4 col-form-label">Choose a file to upload</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="file" type="file" id="formFile">
                                </div>
                            </div>
        
                            <div class="col-12 text-center">
                                <button type="submit" class="btn effect01">Submit Manuscript</button>
                            </div>
        
                            @if (session()->has('message'))
                            <div class="alert alert-success text-center">
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
        
                        </form>
                    </div>
                </div>
        
            </div>


           </div>

           <!-- RIGHT SIDEBAR -->
           <div class="col-md-3">



            @include('partials.quicklinks1')
            @include('partials.top_editors')


           </div>



       </div>
   </div>
</div>

  

@endsection
