@extends('layouts.app')
@section('title', 'Our Journals | Corpus Scientific Publisher')
@section('description', 'Browse the complete Corpus Scientific Publisher journal collection, current issues and archives.')
@section('content')
<section class="container publisher-section publisher-all-journals" aria-labelledby="journal-heading">
    <div class="publisher-section-heading">
        <div>
            <p class="publisher-eyebrow">The CSP journal collection</p>
            <h1 id="journal-heading">Our journals</h1>
            <p>Explore our collection and find the right journal for your research.</p>
        </div>
        <span class="publisher-count">{{ $journals->count() }} {{ $journals->count() === 1 ? 'journal' : 'journals' }}</span>
    </div>
    @include('partials.journal-catalogue')
</section>
@endsection
