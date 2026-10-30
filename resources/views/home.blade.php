@extends('layouts.app')
@section('title', 'Corpus Scientific Publisher | Explore Our Journals')
@section('description', 'Explore the Corpus Scientific Publisher journal collection, discover recent research and find guidance for your next manuscript submission.')
@section('content')
<div class="publisher-home">
    <section class="publisher-hero">
        <div class="container publisher-hero-inner">
            <div>
                <p class="publisher-eyebrow">The CSP journal collection</p>
                <h1>Research that moves<br>knowledge forward.</h1>
                <p class="publisher-intro">Discover our journals, explore the latest research, and find the right home for your next manuscript.</p>
                <div class="publisher-actions">
                    <a class="publisher-button" href="#journals">Browse journals <span aria-hidden="true">↓</span>
                    </a>
                    <a class="publisher-text-link" href="{{ url('instructons-for-authors') }}">Information for authors <span aria-hidden="true">↗</span>
                    </a>
                </div>
            </div>
            <aside class="publisher-hero-note">
                <span class="publisher-note-mark" aria-hidden="true">“</span>
                <p>Connecting research<br>with a wider world.</p>
                <span>For readers, authors &amp; the research community</span>
            </aside>
        </div>
    </section>
    <div class="publisher-home-layout container">
        <main class="publisher-home-main" aria-label="Journals, research and publishing">
            <section class="publisher-section" id="journals" aria-labelledby="journal-heading">
        <div class="publisher-section-heading">
            <div>
                <p class="publisher-eyebrow">Find your field. Explore your journal.</p>
                <h2 id="journal-heading">Our journals</h2>
            </div>
            <span class="publisher-count">{{ $journals->count() }} {{ $journals->count() === 1 ? 'journal' : 'journals' }} in our collection</span>
        </div>
        <div class="publisher-catalogue">
            <div class="publisher-carousel-area">
                <div class="publisher-carousel-controls">
                    <span>Explore the collection</span>
                    <div>
                        <button class="publisher-carousel-control" type="button" data-carousel="journal-carousel" data-direction="-1" aria-controls="journal-carousel" aria-label="Show previous journals"><span aria-hidden="true">←</span></button>
                        <button class="publisher-carousel-control" type="button" data-carousel="journal-carousel" data-direction="1" aria-controls="journal-carousel" aria-label="Show next journals"><span aria-hidden="true">→</span></button>
                    </div>
                </div>
                <div class="publisher-carousel publisher-journal-carousel" id="journal-carousel" aria-label="Journal covers">
                    @forelse($journals as $catalogueJournal)
                        @php
                            $assignedCover = $catalogueJournal->photo ?? null;
                            $coverOwner = $assignedCover ? $journals->firstWhere('photo', $assignedCover) : null;
                            $coverIsAssignedToJournal = $coverOwner && $coverOwner->j_id == $catalogueJournal->j_id;
                        @endphp
                        <article class="publisher-journal-slide">
                            <a class="publisher-cover" href="{{ url('journal/' . $catalogueJournal->slug) }}">
                                <span class="publisher-cover-fallback" @if($coverIsAssignedToJournal) hidden @endif>
                                    <span>Corpus Scientific Publisher</span>
                                    <strong>{{ $catalogueJournal->j_name }}</strong>
                                    <span>Journal cover unavailable</span>
                                </span>
                                @if($coverIsAssignedToJournal)
                                    <img src="{{ asset('assets/journals/img/' . $catalogueJournal->photo) }}" alt="" width="260" height="350" onerror="this.hidden=true; this.previousElementSibling.hidden=false;">
                                @endif
                                <span class="publisher-cover-overlay">
                                    <strong>{{ $catalogueJournal->j_name }}</strong>
                                    @if(!empty($catalogueJournal->subject))<span>{{ $catalogueJournal->subject }}</span>@endif
                                    <span class="publisher-cover-action">Explore journal <span aria-hidden="true">↗</span></span>
                                </span>
                            </a>
                        </article>
                    @empty
                        <div class="publisher-empty">
                            <h3>Our catalogue is being updated.</h3>
                            <p>Please check back soon to explore our journals, or <a href="{{ url('contact-us') }}">contact our editorial team</a>.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>
    <section class="publisher-home-mission" aria-labelledby="mission-heading">
        <div class="publisher-mission-intro">
            <p class="publisher-eyebrow">Purpose &amp; direction</p>
            <h2 id="mission-heading">Research deserves a clear path to the world.</h2>
            <p>We connect rigorous scholarship with the readers, practitioners, and communities who can put it to use.</p>
        </div>
        <div class="publisher-mission-values">
            <article>
                <span>01 / Our mission</span>
                <h3>Make quality research easier to share.</h3>
                <p>Our mission is to provide academicians, researchers, and scholars with up-to-date information on discoveries, developments, and ongoing activities in the fields of science and technology. We aim to make this information easily accessible, enabling individuals in these domains to stay informed effortlessly.

</p>
            </article>
            <article>
                <span>02 / Our vision</span>
                <h3>Build trust through open scholarship.</h3>
                <p>Our vision is to uphold the highest standards of quality in the publication of research and review articles. We are deeply committed to the timely and effective dissemination of peer-reviewed, top-quality work. To achieve this, we have assembled a team of esteemed editorial members representing diverse disciplines and specializations. Their dedication ensures an efficient and constructive review process that aligns with international research publishing standards.</p>
            </article>
        </div>
    </section>
        </main>
        <aside class="publisher-home-rail" aria-label="Explore and connect">
            <section class="publisher-rail-card publisher-rail-directory" aria-labelledby="journal-directory-heading">
            <div class="publisher-journal-directory">
                <div class="publisher-rail-heading">
                    <p class="publisher-eyebrow">Browse by title</p>
                    <h3 id="journal-directory-heading">The journal directory</h3>
                </div>
                <ul>
                    @forelse($journals as $directoryJournal)
                        <li><a href="{{ url('journal/' . $directoryJournal->slug) }}">{{ $directoryJournal->j_name }} <span aria-hidden="true">↗</span></a></li>
                    @empty
                        <li class="publisher-directory-empty">Journal listings will be available soon.</li>
                    @endforelse
                </ul>
            </div>
            </section>
            <section class="publisher-rail-card publisher-rail-editors" aria-labelledby="editor-heading">
    <div class="publisher-editorial" aria-labelledby="editor-heading">
        <div class="container publisher-section">
            <div class="publisher-section-heading">
                <div class="publisher-rail-heading">
                    <p class="publisher-eyebrow">Guided by scholars</p>
                    <h2 id="editor-heading">Top editors</h2>
                </div>
                    @if($editors->isNotEmpty())
                        <div class="publisher-carousel-controls">
                        <span>Meet our active editorial community</span>
                        <div>
                            <button class="publisher-carousel-control" type="button" data-carousel="editor-carousel" data-direction="-1" aria-controls="editor-carousel" aria-label="Show previous editors"><span aria-hidden="true">←</span></button>
                            <button class="publisher-carousel-control" type="button" data-carousel="editor-carousel" data-direction="1" aria-controls="editor-carousel" aria-label="Show next editors"><span aria-hidden="true">→</span></button>
                        </div>
                    </div>
                @endif
            </div>
            @if($editors->isNotEmpty())
                <div class="publisher-carousel publisher-editor-carousel" id="editor-carousel" aria-label="Top editors">
                    @foreach($editors as $editor)
                        <article class="publisher-editor-slide">
                            @if(!empty($editor->journal_slug))
                                <a class="publisher-editor-image" href="{{ url('editorial-board/' . $editor->journal_slug) }}" aria-label="View {{ $editor->name }} on the {{ $editor->j_name }} editorial board">
                            @else
                                <div class="publisher-editor-image">
                            @endif
                                <span class="publisher-editor-fallback" @if(!empty($editor->image)) hidden @endif aria-hidden="true">{{ collect(explode(' ', trim($editor->name)))->filter()->map(function ($part) { return mb_substr($part, 0, 1); })->take(2)->implode('') }}</span>
                                @if(!empty($editor->image))
                                    <img src="{{ asset('assets/img/editor-img/' . $editor->image) }}" alt="{{ $editor->name }}" loading="lazy" width="180" height="180" onerror="this.hidden=true; this.previousElementSibling.hidden=false;">
                                @endif
                            @if(!empty($editor->journal_slug))
                                </a>
                            @else
                                </div>
                            @endif
                            <div class="publisher-editor-details">
                                <h3>
                                    @if(!empty($editor->journal_slug))
                                        <a href="{{ url('editorial-board/' . $editor->journal_slug) }}">{{ $editor->name }}</a>
                                    @else
                                        {{ $editor->name }}
                                    @endif
                                </h3>
                                @if(!empty($editor->designation))
                                    <p>{{ $editor->designation }}</p>
                                @elseif(!empty($editor->type))
                                    <p>{{ $editor->type }}</p>
                                @endif
                                @if(!empty($editor->j_name))
                                    <span>{{ $editor->j_name }}</span>
                                @elseif(!empty($editor->university))
                                    <span>{{ $editor->university }}</span>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="publisher-empty">
                    <p>Our editorial community is being updated. Visit a journal page to learn more about its editorial board.</p>
                </div>
            @endif
        </div>
    </div>
            </section>
            <section class="publisher-rail-card publisher-quick-links" aria-labelledby="quick-links-heading">
                <div class="publisher-rail-heading">
                    <h2 id="quick-links-heading">Quick links</h2>
                </div>
                <a href="{{ url('instructons-for-authors') }}">Author guidelines <span aria-hidden="true">↗</span></a>
                <a href="{{ url('review-process') }}">Review process <span aria-hidden="true">↗</span></a>
                <a href="{{ url('publication-ethics') }}">Publication ethics <span aria-hidden="true">↗</span></a>
                <a href="{{ url('contact-us') }}">Contact the editorial team <span aria-hidden="true">↗</span></a>
                <div class="publisher-rail-publish">
                    <p class="publisher-eyebrow">Publish with us</p>
                    <h3>Share your research with a wider community.</h3>
                    <p>Find the right journal and take the next step toward publication.</p>
                    <a class="publisher-button publisher-rail-submit" href="{{ url('submit-article') }}">Submit your manuscript <span aria-hidden="true">↗</span></a>
                </div>
            </section>
        </aside>
    </div>
    <section class="publisher-home-latest-full" aria-labelledby="research-heading">
        <div class="container publisher-section">
            <div class="publisher-section-heading">
                <div>
                    <p class="publisher-eyebrow">From our research community</p>
                    <h2 id="research-heading">Latest articles</h2>
                    <p class="publisher-section-lede">Explore recently published work across our journals.</p>
                </div>
                <a class="publisher-text-link" href="{{ route('article.search') }}">Search all articles <span aria-hidden="true">↗</span></a>
            </div>
            @if($articles->isNotEmpty())
                <div class="publisher-home-article-grid">
                    @foreach($articles as $article)
                        @php
                            $articleJournal = $journals->firstWhere('j_id', $article->j_id);
                            $articleAbstract = \Illuminate\Support\Str::limit(\App\Support\ScholarlyMetadata::text($article->abstract ?? ''), 300);
                            $publishedDate = \App\Support\ScholarlyMetadata::date($article->published_date ?? '');
                            $doiValue = trim((string) ($article->doi ?? ''));
                            $doiHref = trim((string) ($article->doi_link ?? ''));
                            $doiHrefIsSafe = filter_var($doiHref, FILTER_VALIDATE_URL)
                                && in_array(strtolower(parse_url($doiHref, PHP_URL_SCHEME) ?: ''), ['http', 'https'], true);
                            if (!$doiHrefIsSafe && $doiValue !== '') {
                                $doiValue = preg_replace('~^doi:\s*~i', '', $doiValue);
                                $doiHref = preg_match('~^https?://~i', $doiValue) ? $doiValue : 'https://doi.org/' . ltrim($doiValue, '/');
                            }
                        @endphp
                        <article class="publisher-home-article-card">
                            <div class="publisher-home-article-meta">
                                <span>{{ $article->article_type ?: 'Research article' }}</span>
                                @if($publishedDate)<time datetime="{{ $publishedDate }}">{{ $publishedDate }}</time>@endif
                            </div>
                            <h3><a href="{{ url('article/' . $article->slug) }}">{{ $article->name }}</a></h3>
                            @if($articleJournal)
                                <a class="publisher-home-article-journal" href="{{ url('journal/' . $articleJournal->slug) }}">{{ $articleJournal->j_name }}</a>
                            @endif
                            <p class="publisher-home-article-authors"><strong>Authors</strong> {!! \App\Support\ArticleAuthors::display($article->aname) !!}</p>
                            @if($articleAbstract !== '')
                                <p class="publisher-home-article-abstract">{{ $articleAbstract }}</p>
                            @endif
                            <div class="publisher-home-article-details">
                                @if($doiValue !== '')<span><strong>DOI</strong> <a href="{{ $doiHref }}" target="_blank" rel="noopener noreferrer">{{ $doiValue }}</a></span>@endif
                                @if($article->page)<span><strong>Pages</strong> {{ $article->page }}</span>@endif
                            </div>
                            <div class="publisher-home-article-actions">
                                <a href="{{ url('article/' . $article->slug) }}">Read article <span aria-hidden="true">↗</span></a>
                                @if($article->file)
                                    <a href="{{ asset('assets/articles/' . $article->file) }}" target="_blank" rel="noopener noreferrer">Download PDF <span aria-hidden="true">↓</span></a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="publisher-empty publisher-home-articles-empty">
                    <p>New research will appear here as articles are published. <a href="#journals">Explore our journals</a> to learn more.</p>
                </div>
            @endif
        </div>
    </section>
    <section class="publisher-home-indexing-band" aria-labelledby="indexing-heading">
        <div class="container publisher-section publisher-indexing-section">
        <div class="publisher-section-heading">
            <div>
                <p class="publisher-eyebrow">Discoverability &amp; standards</p>
                <h2 id="indexing-heading">Indexing &amp; abstracting</h2>
            </div>
            @if($indexings->isNotEmpty())
                <div class="publisher-carousel-controls">
                    <span>Our active indexing services</span>
                    <div>
                        <button class="publisher-carousel-control" type="button" data-carousel="indexing-carousel" data-direction="-1" aria-controls="indexing-carousel" aria-label="Show previous indexing services"><span aria-hidden="true">←</span></button>
                        <button class="publisher-carousel-control" type="button" data-carousel="indexing-carousel" data-direction="1" aria-controls="indexing-carousel" aria-label="Show next indexing services"><span aria-hidden="true">→</span></button>
                    </div>
                </div>
            @endif
        </div>
        @if($indexings->isNotEmpty())
            <div class="publisher-carousel publisher-indexing-carousel" id="indexing-carousel" aria-label="Active indexing and abstracting services">
                @foreach($indexings as $indexing)
                    @php
                        $indexingLabel = trim($indexing->name ?? '') ?: 'Indexing service';
                        $indexingUrl = trim($indexing->link ?? '');
                        $indexingHost = strtolower(parse_url($indexingUrl, PHP_URL_HOST) ?: '');
                        $indexingHostIsPlaceholder = $indexingHost === 'google.com'
                            || substr($indexingHost, -11) === '.google.com';
                        $indexingLinkIsValid = filter_var($indexingUrl, FILTER_VALIDATE_URL)
                            && in_array(strtolower(parse_url($indexingUrl, PHP_URL_SCHEME) ?: ''), ['http', 'https'], true)
                            && !$indexingHostIsPlaceholder;
                    @endphp
                    <article class="publisher-indexing-slide">
                        @if($indexingLinkIsValid)
                            <a href="{{ $indexingUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Visit {{ $indexingLabel }} (opens in a new tab)">
                        @else
                            <div class="publisher-indexing-card">
                        @endif
                            <span class="publisher-indexing-image">
                                <span class="publisher-indexing-fallback" @if(!empty($indexing->img)) hidden @endif aria-hidden="true">Indexing</span>
                                @if(!empty($indexing->img))
                                    <img src="{{ asset('assets/indexing/img/' . $indexing->img) }}" alt="{{ $indexingLabel }} logo" loading="lazy" width="220" height="120" onerror="this.hidden=true; this.previousElementSibling.hidden=false;">
                                @endif
                            </span>
                            <strong>{{ $indexingLabel }}</strong>
                        @if($indexingLinkIsValid)
                            </a>
                        @else
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        @else
            <div class="publisher-empty">
                <p>Indexing and abstracting information will be added as services are confirmed.</p>
            </div>
        @endif
        </div>
    </section>
    <section class="publisher-home-stats" aria-label="Corpus Scientific Publisher at a glance">
        <div class="container publisher-home-stats-inner">
            <div><strong>{{ number_format($countJournal) }}</strong><span>Active journals</span></div>
            <div><strong>{{ number_format($countArticle) }}</strong><span>Published articles</span></div>
            <div><strong>{{ number_format($countDownload) }}</strong><span>Article downloads</span></div>
        </div>
    </section>

</div>
<script>
    (() => {
        const controls = document.querySelectorAll('.publisher-home [data-carousel][data-direction]');
        const updateControls = (carousel) => {
            if (!carousel) return;
            const maxScroll = carousel.scrollWidth - carousel.clientWidth;
            document.querySelectorAll(`[data-carousel="${carousel.id}"]`).forEach((control) => {
                control.disabled = maxScroll <= 1
                    || (control.dataset.direction === '-1' && carousel.scrollLeft <= 1)
                    || (control.dataset.direction === '1' && carousel.scrollLeft >= maxScroll - 1);
            });
        };

        controls.forEach((control) => {
            const carousel = document.getElementById(control.dataset.carousel);
            if (!carousel) return;
            control.addEventListener('click', () => {
                const direction = Number(control.dataset.direction);
                carousel.scrollBy({
                    left: direction * carousel.clientWidth * 0.85,
                    behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth'
                });
            });
            carousel.addEventListener('scroll', () => updateControls(carousel), { passive: true });
            updateControls(carousel);
        });

        const journalCarousel = document.getElementById('journal-carousel');
        const journalSection = journalCarousel?.closest('#journals');
        if (journalCarousel && journalCarousel.children.length > 1 && journalSection) {
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            let journalAutoAdvance;
            const stopJournalAutoAdvance = () => window.clearInterval(journalAutoAdvance);
            const startJournalAutoAdvance = () => {
                stopJournalAutoAdvance();
                if (reducedMotion.matches || document.hidden) return;
                journalAutoAdvance = window.setInterval(() => {
                    if (journalSection.matches(':hover') || journalSection.contains(document.activeElement)) return;
                    const maxScroll = journalCarousel.scrollWidth - journalCarousel.clientWidth;
                    if (maxScroll <= 1) return;
                    const atEnd = journalCarousel.scrollLeft >= maxScroll - 2;
                    journalCarousel.scrollTo({
                        left: atEnd ? 0 : Math.min(maxScroll, journalCarousel.scrollLeft + journalCarousel.clientWidth * 0.78),
                        behavior: 'smooth'
                    });
                }, 6000);
            };
            journalSection.addEventListener('mouseenter', stopJournalAutoAdvance);
            journalSection.addEventListener('mouseleave', startJournalAutoAdvance);
            journalSection.addEventListener('focusin', stopJournalAutoAdvance);
            journalSection.addEventListener('focusout', (event) => {
                if (!journalSection.contains(event.relatedTarget)) startJournalAutoAdvance();
            });
            document.addEventListener('visibilitychange', startJournalAutoAdvance);
            reducedMotion.addEventListener?.('change', startJournalAutoAdvance);
            startJournalAutoAdvance();
        }

        const indexingCarousel = document.getElementById('indexing-carousel');
        const indexingSection = indexingCarousel?.closest('.publisher-indexing-section');
        if (indexingCarousel && indexingCarousel.children.length > 1 && indexingSection) {
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            let indexingAutoAdvance;
            const stopIndexingAutoAdvance = () => window.clearInterval(indexingAutoAdvance);
            const startIndexingAutoAdvance = () => {
                stopIndexingAutoAdvance();
                if (reducedMotion.matches || document.hidden) return;
                indexingAutoAdvance = window.setInterval(() => {
                    if (indexingSection.matches(':hover') || indexingSection.contains(document.activeElement)) return;
                    const maxScroll = indexingCarousel.scrollWidth - indexingCarousel.clientWidth;
                    if (maxScroll <= 1) return;
                    const atEnd = indexingCarousel.scrollLeft >= maxScroll - 2;
                    const firstItem = indexingCarousel.querySelector('.publisher-indexing-slide');
                    const gap = parseFloat(getComputedStyle(indexingCarousel).gap) || 0;
                    const step = firstItem ? firstItem.getBoundingClientRect().width + gap : indexingCarousel.clientWidth * 0.8;
                    indexingCarousel.scrollTo({
                        left: atEnd ? 0 : Math.min(maxScroll, indexingCarousel.scrollLeft + step * 2),
                        behavior: 'smooth'
                    });
                }, 5000);
            };
            indexingSection.addEventListener('mouseenter', stopIndexingAutoAdvance);
            indexingSection.addEventListener('mouseleave', startIndexingAutoAdvance);
            indexingSection.addEventListener('focusin', stopIndexingAutoAdvance);
            indexingSection.addEventListener('focusout', (event) => {
                if (!indexingSection.contains(event.relatedTarget)) startIndexingAutoAdvance();
            });
            document.addEventListener('visibilitychange', startIndexingAutoAdvance);
            reducedMotion.addEventListener?.('change', startIndexingAutoAdvance);
            startIndexingAutoAdvance();
        }

        const editorCarousel = document.getElementById('editor-carousel');
        const editorSection = editorCarousel?.closest('.publisher-editorial');
        if (editorCarousel && editorCarousel.children.length > 1) {
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            let autoAdvance;
            const stopAutoAdvance = () => window.clearInterval(autoAdvance);
            const startAutoAdvance = () => {
                stopAutoAdvance();
                if (reducedMotion.matches || document.hidden) return;
                autoAdvance = window.setInterval(() => {
                    if (editorSection.matches(':hover') || editorSection.contains(document.activeElement)) return;
                    const maxScroll = editorCarousel.scrollWidth - editorCarousel.clientWidth;
                    const atEnd = editorCarousel.scrollLeft >= maxScroll - 2;
                    editorCarousel.scrollTo({
                        left: atEnd ? 0 : Math.min(maxScroll, editorCarousel.scrollLeft + editorCarousel.clientWidth * 0.85),
                        behavior: 'smooth'
                    });
                }, 5000);
            };
            editorSection.addEventListener('mouseenter', stopAutoAdvance);
            editorSection.addEventListener('mouseleave', startAutoAdvance);
            editorSection.addEventListener('focusin', stopAutoAdvance);
            editorSection.addEventListener('focusout', (event) => {
                if (!editorSection.contains(event.relatedTarget)) startAutoAdvance();
            });
            document.addEventListener('visibilitychange', startAutoAdvance);
            reducedMotion.addEventListener?.('change', startAutoAdvance);
            startAutoAdvance();
        }

        window.addEventListener('resize', () => {
            document.querySelectorAll('.publisher-home .publisher-carousel').forEach(updateControls);
        });
    })();
</script>
@endsection
