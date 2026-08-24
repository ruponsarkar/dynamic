@extends('adminpanel/layout')
@section('title', 'Dashboard')
@section('content')

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            /* padding: 18px;
          margin-left: 10px; */
            border: 1px solid #dddddd;
            text-align: left;

        }

        td,
        th {
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        tr:nth-child(1) {
            background-color: deeppink;
        }

        body {
            font: normal 18px/1.5 "Fira Sans", "Helvetica Neue", sans-serif;
            background: #3AAFAB;
            color: #000;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .container * {
            box-sizing: border-box;
        }

        .flex-outer,
        .flex-inner {
            list-style-type: none;
            padding: 0;
        }

        .flex-outer {
            max-width: 800px;
            margin: 0 auto;
        }

        .flex-outer li,
        .flex-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .flex-inner {
            padding: 0 8px;
            justify-content: space-between;
        }

        .flex-outer>li:not(:last-child) {
            margin-bottom: 20px;
        }

        .flex-outer li label,
        .flex-outer li p {
            padding: 8px;
            font-weight: 300;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .flex-outer>li>label,
        .flex-outer li p {
            flex: 1 0 120px;
            max-width: 220px;
        }

        .flex-outer>li>label+*,
        .flex-inner {
            flex: 1 0 220px;
        }

        .flex-outer li p {
            margin: 0;
        }

        .flex-outer li input:not([type='checkbox']),
        .flex-outer li textarea,
        select {
            padding: 15px;
            border: none;
        }

        .flex-outer li button {
            margin-left: auto;
            padding: 8px 16px;
            border: none;
            background: #333;
            color: #f3f3f3;
            text-transform: uppercase;
            letter-spacing: .09em;
            border-radius: 2px;
        }

        .flex-inner li {
            width: 100px;
        }
    </style>
    <div class="container">

        <h1>Update Editors</h1>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="error_msg">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>
                        <div class="alert alert-danger">{{ $e }} </div>
                    </li>
                @endforeach
            </ul>
        </div>



        <form action="updateEditors/{{ $editors->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="one pt-3">
                <label for="jname">Editors Name</label>
                <input type="text" name="name" value="{{ $editors->name }}" id="" class="form-control">
            </div>

            <div class="one pt-3">
                <label for="abbr">Designation</label>
                <input type="text" name="designation" value="{{ $editors->designation }}" id=""
                    class="form-control">
            </div>
            <div class="one pt-3">
                <label for="abbr">Department Name</label>
                <input type="text" name="university" value="{{ $editors->university }}" id=""
                    class="form-control">
            </div>

            <div class="one pt-3">
                <label for="issn">Address (*Optional)</label>
                <input type="text" name="details" value="{{ $editors->details }}" id="" class="form-control">
            </div>

            <div class="one pt-3">
                <label for="issn">Official Email address</label>
                <input type="text" name="email" value="{{ $editors->email }}" id="" class="form-control">
            </div>

            <div class="one pt-3">
              <label for="type">Type</label>
          
              <select name="type" id="type" required class="form-select">
                  <option value="">-- Select Type --</option>
          
                  <option value="Associative"
                      {{ old('type', $editors->type) == 'Associative' ? 'selected' : '' }}>
                      Associative
                  </option>
          
                  <option value="Chief"
                      {{ old('type', $editors->type) == 'Chief' ? 'selected' : '' }}>
                      Chief
                  </option>
              </select>
          </div>

          
          

            <div class="one pt-3">
              <label for="journal">For Journal</label>
          
              <select name="journal" id="journal" required class="form-select">
                  <option value="">-- Select Journal --</option>
          
                  @foreach ($journal as $data)
                      <option value="{{ $data->j_id }}"
                          {{ $editors->j_id == $data->j_id ? 'selected' : '' }}>
                          {{ $data->j_name }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div class="one pt-3">
            <label for="issn">Do you want to add this editor as top editors</label>
            <select name="is_top_editor" id="top" required class="form-select">
                <option value="">-- Select --</option>
                <option value="1"
                    {{ old('top', $editors->is_top_editor) == '1' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="0"
                    {{ old('top', $editors->is_top_editor) == '0' ? 'selected' : '' }}>
                    No
                </option>
            </select>
        </div>
          


            <div class="one pt-3">
                <label for="abbr">Profile Link: </label>
                <input type="text" name="profile" value="{{ $editors->profile }}" id="profile" class="form-control">
            </div>



            <div class="one pt-3">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="" class="form-control">
            </div>

            <div class="one text-center m-3">

                <input type="submit" name="submit-editors" value="Save" id="" class="btn btn-primary">
            </div>
        </form>


    </div>
@endsection
