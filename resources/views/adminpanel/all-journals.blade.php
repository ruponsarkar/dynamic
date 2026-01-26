
@extends('adminpanel/layout')

@section('title', 'Home')
@section('breadcrumb', 'Add Journals')


@section('content')
  <style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  
  tr:nth-child(1) {
    background-color: #dddddd;
  }
  </style>

<center><h2>Edit Journals</h2></center>

<table>
  <tr>
    <th>Name</th>
    <th>Abbr. titles</th>
    <th>ISSN</th>
    <th>Frequency</th>
    <th>Language</th>
    <th>Chief Editor</th>

    <th>Publisher</th>
    <th>Country of origin</th>
    <th>Aim and Scope</th>
    <th>Image</th>
    <th>Update</th>

  </tr>
@foreach($journal as $data)
  <tr>
    <td>{{$data->j_name}}</td>
    <td>{{$data->abbr_title}}</td>
    <td>{{$data->issn}}</td>
    <td>{{$data->frequency}}</td>
    <td>{{$data->language}}</td>
    <td>{{$data->chief_editor}}</td>
    <td>{{$data->publisher}}</td>
    <td>{{$data->country_of_origin}}</td>
    <td>{{$data->aim_and_scope}}</td>
    
    

    <td><a href="../assets/journals/{{$data->photo}}">{{$data->photo}}</a></td>
    <td><a href="{{URL('update-journals/'.$data->j_id)}}">Update</a></td>
  </tr>
@endforeach
</table>
@include('adminpanel.admin_partial.dash-bottom')
@endsection