@extends('layouts.app')

@section('title', 'Author Dashboard')

@section('content')
    <div class="container py-4">
        <div class="card-c p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                <div>
                    <h1 class="h4 mb-1" style="color: #1976d2; font-weight: bold;">Author Dashboard</h1>
                    <div class="text-muted small">Welcome, {{ $author->name }}</div>
                </div>
                <div class="d-flex gap-2">
                    <a class="btn btn-primary" href="{{ url('manuscript') }}">Submit Manuscript</a>
                    <form method="POST" action="{{ route('author.logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger" type="submit">Logout</button>
                    </form>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            @endif

            @if ($manuscripts->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Unique ID</th>
                                <th>Manuscript</th>
                                <th>Journal</th>
                                <th>Type</th>
                                <th>Submitted</th>
                                <th>Status</th>
                                <th>History</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manuscripts as $manuscript)
                                <tr>
                                    <td>{{ $manuscript->muuid }}</td>
                                    <td>{{ $manuscript->manuscript }}</td>
                                    <td>{{ $manuscript->journal }}</td>
                                    <td>{{ $manuscript->type }}</td>
                                    <td>{{ $manuscript->date }}</td>
                                    <td>
                                        <span class="btn btn-sm btn-info">
                                            {{ $statusLabels[$manuscript->status] ?? 'Rejected' }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach ($statusHistory->get($manuscript->muuid, collect())->take(3) as $history)
                                            <div class="small">
                                                {{ $history->date }} -
                                                {{ $statusLabels[$history->status] ?? 'Rejected' }}
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    You have not submitted any manuscripts yet.
                </div>
            @endif
        </div>
    </div>
@endsection
