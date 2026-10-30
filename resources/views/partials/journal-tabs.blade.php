@php($activeJournalTab = $activeJournalTab ?? '')
<nav class="publisher-journal-tabs" aria-label="{{ $journal->j_name }} journal sections">
    <a href="{{ url('current-issue/' . $journal->slug) }}" @if($activeJournalTab === 'current') aria-current="page" @endif>
        <span>01</span>Current issue
    </a>
    <a href="{{ url('journal/' . $journal->slug) }}" @if($activeJournalTab === 'about') aria-current="page" @endif>
        <span>02</span>About the journal
    </a>
    <a href="{{ url('archives/' . $journal->slug) }}" @if($activeJournalTab === 'archive') aria-current="page" @endif>
        <span>03</span>Archive
    </a>
    <a href="{{ url('editorial-board/' . $journal->slug) }}" @if($activeJournalTab === 'editorial') aria-current="page" @endif>
        <span>04</span>Editorial panel
    </a>
</nav>
