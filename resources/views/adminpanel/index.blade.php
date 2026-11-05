@extends('adminpanel/layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
    @php
        $statusRows = [
            ['status' => 0, 'label' => 'Initial stage', 'color' => 'slate'],
            ['status' => 1, 'label' => 'In review', 'color' => 'blue'],
            ['status' => 2, 'label' => 'Editorial approval', 'color' => 'amber'],
            ['status' => 3, 'label' => 'Re-review', 'color' => 'violet'],
            ['status' => 4, 'label' => 'Final verification', 'color' => 'teal'],
            ['status' => 5, 'label' => 'Published', 'color' => 'green'],
            ['status' => 6, 'label' => 'Rejected', 'color' => 'red'],
        ];
        $statusLabels = collect($statusRows)->pluck('label', 'status');
        $maxJournalArticleCount = max(1, (int) $topJournalArticleCounts->max('total'));
    @endphp

    <main class="admin-dashboard">
        <header class="admin-dashboard-heading">
            <div>
                <span class="admin-dashboard-kicker">Publishing overview</span>
                <h1>Dashboard</h1>
                <p>A clear view of journals, submissions, published work, and readership.</p>
            </div>
            <div class="admin-dashboard-heading-actions">
                <span class="admin-dashboard-date"><i class="far fa-calendar-alt" aria-hidden="true"></i> {{ now()->format('F j, Y') }}</span>
                <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary"><i class="fas fa-external-link-alt" aria-hidden="true"></i> View site</a>
                <form action="{{ url('clear-cache') }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-broom" aria-hidden="true"></i> Clear cache</button>
                </form>
            </div>
        </header>

        <section class="admin-dashboard-kpis" aria-label="Publishing metrics">
            <article class="admin-kpi-card">
                <span class="admin-kpi-icon admin-kpi-icon-wine"><i class="fas fa-book-open" aria-hidden="true"></i></span>
                <div><span class="admin-kpi-label">Journal portfolio</span><strong>{{ number_format($countJournal) }}</strong><small>{{ number_format($activeJournalCount) }} active · {{ number_format($inactiveJournalCount) }} inactive</small></div>
            </article>
            <article class="admin-kpi-card">
                <span class="admin-kpi-icon admin-kpi-icon-blue"><i class="fas fa-file-alt" aria-hidden="true"></i></span>
                <div><span class="admin-kpi-label">Published articles</span><strong>{{ number_format($countArticle) }}</strong><small>Across all journals</small></div>
            </article>
            <article class="admin-kpi-card">
                <span class="admin-kpi-icon admin-kpi-icon-gold"><i class="fas fa-download" aria-hidden="true"></i></span>
                <div><span class="admin-kpi-label">Article downloads</span><strong>{{ number_format($countDownload) }}</strong><small>Recorded total</small></div>
            </article>
            <article class="admin-kpi-card">
                <span class="admin-kpi-icon admin-kpi-icon-teal"><i class="fas fa-inbox" aria-hidden="true"></i></span>
                <div><span class="admin-kpi-label">Open submissions</span><strong>{{ number_format($openManuscriptCount) }}</strong><small>{{ number_format($manuscriptTotal) }} total submissions</small></div>
            </article>
        </section>

        <section class="admin-dashboard-grid admin-dashboard-grid-top">
            <article class="admin-dashboard-panel admin-status-panel">
                <header class="admin-panel-heading">
                    <div><span>Editorial workflow</span><h2>Submission status</h2></div>
                    <a href="{{ url('all-manuscript') }}">Manage submissions <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </header>
                <div class="admin-status-summary">
                    <strong>{{ number_format($openManuscriptCount) }}</strong>
                    <span>open submissions</span>
                    <div class="admin-status-summary-total">of {{ number_format($manuscriptTotal) }} total</div>
                </div>
                <div class="admin-status-bars">
                    @foreach ($statusRows as $row)
                        @php
                            $statusCount = (int) $manuscriptStatusCounts->get($row['status'], 0);
                            $statusPercent = $manuscriptTotal > 0 ? ($statusCount / $manuscriptTotal) * 100 : 0;
                        @endphp
                        <div class="admin-status-row">
                            <div class="admin-status-row-label"><span>{{ $row['label'] }}</span><strong>{{ number_format($statusCount) }}</strong></div>
                            <div class="admin-status-track"><span class="admin-status-fill admin-status-{{ $row['color'] }}" style="width: {{ $statusPercent }}%"></span></div>
                        </div>
                    @endforeach
                </div>
                <div class="admin-status-outcomes">
                    <span><i class="fas fa-check-circle" aria-hidden="true"></i> {{ number_format($publishedManuscriptCount) }} published</span>
                    <span><i class="fas fa-times-circle" aria-hidden="true"></i> {{ number_format($rejectedManuscriptCount) }} rejected</span>
                </div>
            </article>

            <article class="admin-dashboard-panel admin-journal-performance">
                <header class="admin-panel-heading">
                    <div><span>Published output</span><h2>Articles by journal</h2></div>
                    <a href="{{ url('journalForm') }}">View journals <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </header>
                @forelse ($topJournalArticleCounts as $journalStat)
                    @php
                        $journalRecord = $topJournals->get($journalStat->j_id);
                        $articlePercent = ((int) $journalStat->total / $maxJournalArticleCount) * 100;
                    @endphp
                    <div class="admin-journal-performance-row">
                        <div class="admin-journal-performance-label"><span>{{ $journalRecord->j_name ?? 'Journal #' . $journalStat->j_id }}</span><strong>{{ number_format($journalStat->total) }}</strong></div>
                        <div class="admin-journal-performance-track"><span style="width: {{ $articlePercent }}%"></span></div>
                    </div>
                @empty
                    <div class="admin-dashboard-empty"><i class="fas fa-chart-bar" aria-hidden="true"></i><p>Published article totals will appear here.</p></div>
                @endforelse
                <div class="admin-journal-performance-footnote">Ranked by published article count.</div>
            </article>
        </section>

        <section class="admin-dashboard-grid admin-dashboard-grid-bottom">
            <article class="admin-dashboard-panel admin-dashboard-table-panel">
                <header class="admin-panel-heading">
                    <div><span>Latest activity</span><h2>Recent submissions</h2></div>
                    <a href="{{ url('all-manuscript') }}">All submissions <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </header>
                <div class="table-responsive">
                    <table class="table admin-dashboard-table">
                        <thead><tr><th>Manuscript</th><th>Author</th><th>Journal</th><th>Submitted</th><th>Status</th></tr></thead>
                        <tbody>
                            @forelse ($recentManuscripts as $submission)
                                @php
                                    $submissionStatus = (int) $submission->status;
                                    $submissionStatusLabel = $statusLabels->get($submissionStatus, 'Unknown');
                                @endphp
                                <tr>
                                    <td><a class="admin-dashboard-record-link" href="{{ url('viewer/' . $submission->m_id) }}">{{ \Illuminate\Support\Str::limit($submission->manuscript, 52) }}</a><small>{{ $submission->muuid }}</small></td>
                                    <td>{{ $submission->author }}</td>
                                    <td>{{ $submission->journal }}</td>
                                    <td>{{ $submission->date }}</td>
                                    <td><span class="admin-dashboard-status-pill admin-dashboard-status-{{ $submissionStatus }}">{{ $submissionStatusLabel }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="admin-table-empty">No submissions have been received yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </article>

            <article class="admin-dashboard-panel admin-recent-articles">
                <header class="admin-panel-heading">
                    <div><span>Research library</span><h2>Recently published</h2></div>
                    <a href="{{ url('journalForm') }}">Manage journals <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </header>
                @forelse ($recentArticles as $recentArticle)
                    @php($articleJournal = $journalNames->get($recentArticle->j_id))
                    <a class="admin-recent-article-item" href="{{ url('article/' . $recentArticle->slug) }}" target="_blank" rel="noopener noreferrer">
                        <span class="admin-recent-article-icon"><i class="far fa-file-alt" aria-hidden="true"></i></span>
                        <span class="admin-recent-article-copy"><strong>{{ \Illuminate\Support\Str::limit($recentArticle->name, 68) }}</strong><small>{{ $articleJournal->j_name ?? 'Journal publication' }} @if($recentArticle->published_date) · {{ $recentArticle->published_date }} @endif</small></span>
                        <i class="fas fa-external-link-alt admin-recent-article-arrow" aria-hidden="true"></i>
                    </a>
                @empty
                    <div class="admin-dashboard-empty"><i class="far fa-file-alt" aria-hidden="true"></i><p>Published articles will appear here.</p></div>
                @endforelse
            </article>
        </section>

        <section class="admin-dashboard-lower-grid">
            <article class="admin-dashboard-panel admin-quick-actions">
                <header class="admin-panel-heading"><div><span>Shortcuts</span><h2>Quick actions</h2></div></header>
                <div class="admin-quick-action-grid">
                    <a href="{{ url('journalForm') }}"><i class="fas fa-book-medical" aria-hidden="true"></i><span>Add or edit journals</span><i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    <a href="{{ url('all-manuscript') }}"><i class="fas fa-inbox" aria-hidden="true"></i><span>Review submissions</span><i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    <a href="{{ url('addEditors') }}"><i class="fas fa-user-plus" aria-hidden="true"></i><span>Manage editors</span><i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    <a href="{{ url('add-volume') }}"><i class="fas fa-layer-group" aria-hidden="true"></i><span>Add a volume</span><i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>

            <article class="admin-dashboard-panel admin-brand-settings">
                <header class="admin-panel-heading"><div><span>Publisher settings</span><h2>Home page assets</h2></div></header>
                <div class="admin-brand-settings-grid">
                    <form action="{{ url('changeHomeAsset') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="admin-home-logo">Publisher logo</label>
                        @if ($HomeAssets && $HomeAssets->logo)
                            <img class="admin-home-logo-preview" src="{{ url('assets/homeAssets/' . $HomeAssets->logo) }}" alt="Current publisher logo">
                        @endif
                        <input id="admin-home-logo" class="form-control" type="file" name="logo" accept=".jpg,.jpeg,.png" required>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-upload" aria-hidden="true"></i> Update logo</button>
                    </form>
                    {{-- <form action="{{ url('changeHomeAsset') }}" method="post">
                        @csrf
                        <label for="admin-impact-factor">Impact factor</label>
                        <input id="admin-impact-factor" class="form-control" type="text" name="impact_factor" value="{{ $HomeAssets->impact_factor ?? '' }}" required>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save" aria-hidden="true"></i> Save value</button>
                    </form> --}}
                </div>
            </article>
        </section>
    </main>
@endsection
