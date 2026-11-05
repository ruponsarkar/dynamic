@extends('layouts.app')

@section('title', 'Author Dashboard')

@section('content')
    <main class="publisher-interior-page publisher-author-dashboard">
        <div class="container py-4 py-lg-5">
            <section class="publisher-dashboard-shell">
                <header class="publisher-dashboard-header">
                    <div>
                        <p class="publisher-eyebrow">Author workspace</p>
                        <h1>Welcome, {{ $author->name }}</h1>
                        <p>Track your submissions and stay up to date with their editorial progress.</p>
                    </div>
                    <div class="publisher-dashboard-actions">
                        <a class="publisher-button" href="{{ url('manuscript') }}">Submit a manuscript <span aria-hidden="true">↗</span></a>
                        <form method="POST" action="{{ route('author.logout') }}">
                            @csrf
                            <button class="publisher-dashboard-logout" type="submit">Log out</button>
                        </form>
                    </div>
                </header>

                @if (session()->has('message'))
                    <div class="alert alert-success mb-4">{{ session()->get('message') }}</div>
                @endif

                <section class="publisher-dashboard-submissions">
                    <div class="publisher-dashboard-section-heading">
                        <div><p class="publisher-eyebrow">Your activity</p><h2>Manuscript submissions</h2></div>
                        <span>{{ $manuscripts->count() }} {{ \Illuminate\Support\Str::plural('submission', $manuscripts->count()) }}</span>
                    </div>

                    @if ($manuscripts->count())
                        <div class="table-responsive">
                            <table class="table publisher-dashboard-table align-middle mb-0">
                                <thead><tr><th>Manuscript</th><th>Journal</th><th>Type</th><th>Submitted</th><th>Status</th><th>Recent history</th></tr></thead>
                                <tbody>
                                    @foreach ($manuscripts as $manuscript)
                                        <tr>
                                            <td><strong>{{ $manuscript->manuscript }}</strong><small>Reference {{ $manuscript->muuid }}</small></td>
                                            <td>{{ $manuscript->journal }}</td>
                                            <td>{{ $manuscript->type }}</td>
                                            <td>{{ $manuscript->date }}</td>
                                            <td><span class="publisher-status-pill publisher-status-{{ $manuscript->status }}">{{ $statusLabels[$manuscript->status] ?? 'Rejected' }}</span></td>
                                            <td>
                                                @forelse ($statusHistory->get($manuscript->muuid, collect())->take(3) as $history)
                                                    <div class="publisher-history-item"><span>{{ $statusLabels[$history->status] ?? 'Rejected' }}</span><small>{{ $history->date }}</small></div>
                                                @empty
                                                    <span class="text-muted">No updates yet</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="publisher-dashboard-empty">
                            <span aria-hidden="true">✦</span>
                            <h3>Your research journey starts here</h3>
                            <p>You haven’t submitted a manuscript yet. Start a submission to follow its progress here.</p>
                            <a class="publisher-button" href="{{ url('manuscript') }}">Start a submission <span aria-hidden="true">↗</span></a>
                        </div>
                    @endif
                </section>
            </section>
        </div>
    </main>
@endsection
