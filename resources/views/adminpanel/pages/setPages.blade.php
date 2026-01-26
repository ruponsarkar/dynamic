@extends('adminpanel/layout')
@section('title', 'Dashboard')
@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


<div class="card p-3">

    <div class="d-flex gap-3">
        <a href="/addpages/about">About Us</a>        
        <a href="/addpages/author">Authors Guidelines</a>        
        <a href="/addpages/reviewer">Reviewers Guidelines</a>        
        <a href="/addpages/editor">Editors Guidelines</a>        
        <a href="/addpages/contact">Contact Us Page</a>        
        <a href="/addpages/PublicationEthicsandMalpracticeStatement">Publication Ethicsand Malpractice Statement</a>        
        <a href="/addpages/ManuscriptPreparationGuidelines">Manuscript Preparation Guidelines</a>        
        <a href="/addpages/MissionStatement">MissionStatement</a>        
        <a href="/addpages/EthicalIssue">Ethica lIssue</a>        
        <a href="/addpages/EditorialPolicy">Editorial Policy</a>        
        <a href="/addpages/PublicationEthics">Publication Ethics</a>        
    </div>
</div>
<div class="container-form  p-1 p-md-3 p-lg-2">
    @yield('setPage')
</div>






@endsection