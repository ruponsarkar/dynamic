<div class="publisher-journal-grid">
    @forelse ($journals as $catalogueJournal)
        <article class="publisher-journal">
            <a class="publisher-cover" href="{{ url('journal/' . $catalogueJournal->slug) }}" aria-label="Explore {{ $catalogueJournal->j_name }}">
                <span class="publisher-cover-fallback" @if(!empty($catalogueJournal->photo)) hidden @endif>
                    <span>Corpus Scientific Publisher</span>
                    <strong>{{ $catalogueJournal->j_name }}</strong>
                    <span>Journal cover unavailable</span>
                </span>
                @if(!empty($catalogueJournal->photo))
                    <img src="{{ asset('assets/journals/img/' . $catalogueJournal->photo) }}" alt="{{ $catalogueJournal->j_name }} journal cover" onerror="this.hidden=true; this.previousElementSibling.hidden=false;" width="260" height="350" loading="lazy" decoding="async">
                @endif
            </a>
            <div class="publisher-journal-info">
                @if(!empty($catalogueJournal->subject))
                    <p class="publisher-eyebrow">{{ $catalogueJournal->subject }}</p>
                @endif
                <h3>
                    <a href="{{ url('journal/' . $catalogueJournal->slug) }}">{{ $catalogueJournal->j_name }}</a>
                </h3>
                <dl class="publisher-journal-meta">
                    @if(!empty($catalogueJournal->issn))
                        <div>
                            <dt>ISSN</dt>
                            <dd>{{ $catalogueJournal->issn }}</dd>
                        </div>
                    @endif
                    @if(!empty($catalogueJournal->frequency))
                        <div>
                            <dt>Frequency</dt>
                            <dd>{{ $catalogueJournal->frequency }}</dd>
                        </div>
                    @endif
                </dl>
                <a class="publisher-text-link" href="{{ url('journal/' . $catalogueJournal->slug) }}">Explore journal <span aria-hidden="true">↗</span>
                </a>
                <div class="publisher-journal-links">
                    <a href="{{ url('current-issue/' . $catalogueJournal->slug) }}">Current issue</a>
                    <a href="{{ url('archives/' . $catalogueJournal->slug) }}">Archive</a>
                </div>
            </div>
        </article>
    @empty
        <div class="publisher-empty">
            <h3>Our catalogue is being updated.</h3>
            <p>Please check back soon to explore our journals, or <a href="{{ url('contact-us') }}">contact our editorial team</a>.</p>
        </div>
    @endforelse
</div>
