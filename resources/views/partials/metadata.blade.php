@php
    $metaTitle = \App\Support\ScholarlyMetadata::text($__env->yieldContent('title', 'IRGS Publisher'));
    $canonical = url()->current();
    $isArticle = request()->is('article/*') && isset($article);
    $isJournal = request()->is('journal/*');
    $description = 'Browse journals, research articles, archives and publication information from IRGS Publisher.';
    if ($isArticle) {
        $description = $article->abstract ?? '';
    } elseif (isset($data) && is_object($data) && isset($data->meta_description)) {
        $description = $data->meta_description;
    } elseif ($isJournal && isset($journal)) {
        $description = $journal->aim_and_scope ?? $journal->j_name;
    } else {
        $description = $metaTitle . '. ' . $description;
    }
    $description = \Illuminate\Support\Str::limit(\App\Support\ScholarlyMetadata::text($description), 200, '…');
    $schema = ['@context' => 'https://schema.org', '@type' => 'WebPage', 'name' => $metaTitle, 'url' => $canonical, 'description' => $description];
    $scholarly = $isArticle ? \App\Support\ScholarlyMetadata::article($article, $journal, $volume ?? null, $issue ?? null) : null;
    if ($scholarly) $schema = $scholarly['schema'];
    if ($isJournal && isset($journal)) {
        $schema['@type'] = 'Periodical';
        $schema['name'] = \App\Support\ScholarlyMetadata::text($journal->j_name);
    }
@endphp
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="{{ request()->is('payments', 'manuscript', 'join-editor', 'join-reviewer') ? 'noindex, follow' : 'index, follow, max-image-preview:large' }}">
<link rel="canonical" href="{{ $canonical }}">
<meta property="og:site_name" content="IRGS Publisher">
<meta property="og:type" content="{{ $isArticle ? 'article' : 'website' }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $description }}">
@if ($scholarly)
    <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/">
    @foreach ($scholarly['tags'] as $tag)
        <meta name="{{ $tag['name'] }}" content="{{ $tag['content'] }}">
    @endforeach
@endif
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
