<div class="publisher-article-list">
    @forelse ($articles as $article)
        @php
            $articleJournal = isset($journals) ? $journals->firstWhere('j_id', $article->j_id) : null;
            $articleAbstract = \Illuminate\Support\Str::limit(\App\Support\ScholarlyMetadata::text($article->abstract ?? ''), 260);
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
        <article class="publisher-article-card">
            <div class="publisher-article-card-meta">
                <span>{{ $article->article_type ?: 'Research article' }}</span>
                @if ($publishedDate)
                    <time datetime="{{ $publishedDate }}">Published {{ $publishedDate }}</time>
                @endif
            </div>
            <h3><a href="{{ url('article/' . $article->slug) }}">{{ $article->name }}</a></h3>
            @if ($articleJournal)
                <a class="publisher-article-card-journal" href="{{ url('journal/' . $articleJournal->slug) }}">{{ $articleJournal->j_name }}</a>
            @endif
            <p class="publisher-article-card-authors"><strong>Authors</strong> {!! \App\Support\ArticleAuthors::display($article->aname) !!}</p>
            @if ($articleAbstract !== '')
                <p class="publisher-article-card-abstract">{{ $articleAbstract }}</p>
            @endif
            <div class="publisher-article-card-details">
                @if ($doiValue !== '')
                    <span><strong>DOI</strong> <a href="{{ $doiHref }}" target="_blank" rel="noopener noreferrer">{{ $doiValue }}</a></span>
                @endif
                @if ($article->page)
                    <span><strong>Pages</strong> {{ $article->page }}</span>
                @endif
            </div>
            <div class="publisher-article-card-actions">
                <a href="{{ url('article/' . $article->slug) }}">Read article <span aria-hidden="true">↗</span></a>
                @if ($article->file)
                    <a href="{{ asset('assets/articles/' . $article->file) }}" target="_blank" rel="noopener noreferrer">Download PDF <span aria-hidden="true">↓</span></a>
                @endif
            </div>
        </article>
    @empty
        <div class="publisher-article-list-empty">
            <strong>No articles are available here yet.</strong>
            <span>Check back soon for newly published research.</span>
        </div>
    @endforelse
</div>
