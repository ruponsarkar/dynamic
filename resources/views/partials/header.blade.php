<header class="publisher-header">
    <div class="publisher-utility">
        <div class="container publisher-utility-inner">
            <span>Research. Discovery. Knowledge.</span>
            <a href="{{ session()->has('AuthorLoggedUser') ? route('author.dashboard') : route('author.login') }}">Author {{ session()->has('AuthorLoggedUser') ? 'dashboard' : 'login' }} <span aria-hidden="true">↗</span>
            </a>
        </div>
    </div>
    <div class="container publisher-masthead">
        <a class="publisher-brand" href="{{ url('/') }}" aria-label="Corpus Scientific Publisher home">
            @if (!empty($assets->logo))
                <img src="{{ asset('assets/homeAssets/' . $assets->logo) }}" alt="" width="64" height="64" onerror="this.hidden=true">
            @endif
            <span>Corpus Scientific <strong>Publisher</strong>
                <small>CSP · A home for scholarly research</small>
            </span>
        </a>
        <form class="publisher-search" action="{{ route('article.search') }}" method="GET" role="search">
            <label class="visually-hidden" for="publisher-search">Search articles</label>
            <input id="publisher-search" type="search" name="q" value="{{ request('q') }}" placeholder="Search articles…">
            <button type="submit" aria-label="Search articles">
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <circle cx="10" cy="10" r="6.5"/>
                    <path d="m15 15 6 6"/>
                </svg>
            </button>
        </form>
        <a class="publisher-button publisher-button-small" href="{{ url('submit-article') }}">Submit manuscript <span aria-hidden="true">↗</span>
        </a>
    </div>
    <nav class="publisher-nav" aria-label="Main navigation">
        <div class="container publisher-nav-container">
            <details class="publisher-nav-disclosure" open>
                <summary class="publisher-nav-toggle"><span>Menu</span><span class="publisher-nav-toggle-icon" aria-hidden="true"></span></summary>
                <div class="publisher-nav-inner" id="publisher-nav-links">
                    <a href="{{ url('/') }}" aria-current="{{ request()->is('/') ? 'page' : 'false' }}">Home</a>
                    <a href="{{ url('journals') }}" aria-current="{{ request()->is('journals', 'journal/*') ? 'page' : 'false' }}">Journals</a>
                    <a href="{{ url('about-us') }}">About us</a>
                    <details class="publisher-menu">
                        <summary>For authors</summary>
                        <div class="publisher-menu-panel">
                            <a href="{{ url('instructons-for-authors') }}">Author guidelines</a>
                            <a href="{{ url('review-process') }}">Review process</a>
                            <a href="{{ url('publication-ethics') }}">Publication ethics</a>
                            <a href="{{ url('processing-fee') }}">Article processing charges</a>
                            <a href="{{ url('copyrights') }}">Copyright</a>
                        </div>
                    </details>
                    <details class="publisher-menu">
                        <summary>Explore journals</summary>
                        <div class="publisher-menu-panel publisher-journal-menu">
                            @forelse($journals as $navJournal)
                                <div>
                                    <a class="publisher-menu-title" href="{{ url('journal/' . $navJournal->slug) }}">{{ $navJournal->j_name }}</a>
                                    <div class="publisher-menu-links">
                                        <a href="{{ url('current-issue/' . $navJournal->slug) }}">Current issue</a>
                                        <a href="{{ url('archives/' . $navJournal->slug) }}">Archive</a>
                                        <a href="{{ url('editorial-board/' . $navJournal->slug) }}">Editorial board</a>
                                        <a href="{{ url('indexings/' . $navJournal->slug) }}">Indexing</a>
                                    </div>
                                </div>
                            @empty
                                <a href="{{ url('journals') }}">Journal catalogue</a>
                            @endforelse
                        </div>
                    </details>
                    <a href="{{ url('contact-us') }}">Contact</a>
                </div>
            </details>
        </div>
    </nav>
    <script>
        (() => {
            const disclosure = document.querySelector('.publisher-nav-disclosure');
            if (!disclosure) return;

            const desktop = window.matchMedia('(min-width: 761px)');
            const syncNavigation = () => {
                disclosure.open = desktop.matches;
            };

            syncNavigation();
            desktop.addEventListener('change', syncNavigation);
        })();
    </script>
</header>
