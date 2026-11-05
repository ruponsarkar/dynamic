@extends('adminpanel/layout')

@section('title', 'Mission & vision')
@section('breadcrumb', 'Mission & vision')

@section('content')
<section class="content">
    <div class="container-fluid">
        <header class="admin-page-heading">
            <h1>Mission &amp; vision</h1>
            <p>This text appears in the "Purpose &amp; direction" section of the homepage. Changes show immediately after saving.</p>
        </header>

        <form action="{{ url('home-content') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header"><h3 class="card-title">Section introduction</h3></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="home_purpose_heading">Heading</label>
                        <input class="form-control" id="home_purpose_heading" name="home_purpose_heading" maxlength="255" required value="{{ old('home_purpose_heading', $content['home_purpose_heading']) }}">
                    </div>
                    <div>
                        <label class="form-label" for="home_purpose_intro">Introduction</label>
                        <textarea class="form-control" id="home_purpose_intro" name="home_purpose_intro" rows="2" maxlength="1000" required>{{ old('home_purpose_intro', $content['home_purpose_intro']) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach (['mission' => 'Our mission', 'vision' => 'Our vision'] as $section => $label)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">{{ $label }}</h3></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="home_{{ $section }}_title">Title</label>
                                    <input class="form-control" id="home_{{ $section }}_title" name="home_{{ $section }}_title" maxlength="255" required value="{{ old('home_' . $section . '_title', $content['home_' . $section . '_title']) }}">
                                </div>
                                <div>
                                    <label class="form-label" for="home_{{ $section }}_text">Text</label>
                                    <textarea class="form-control" id="home_{{ $section }}_text" name="home_{{ $section }}_text" rows="9" maxlength="5000" required>{{ old('home_' . $section . '_text', $content['home_' . $section . '_text']) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</section>
@endsection
