@php
    $quickLinks = [
        ['label' => 'Author guidelines', 'url' => url('instructons-for-authors')],
        ['label' => 'Review process', 'url' => url('review-process')],
        ['label' => 'Publication ethics', 'url' => url('publication-ethics')],
        ['label' => 'Contact editorial team', 'url' => url('contact-us')],
    ];

    foreach (($extraQuickLinks ?? []) as $extraLink) {
        if (!is_array($extraLink) || empty($extraLink['label']) || empty($extraLink['url'])) {
            continue;
        }

        $linkUrl = trim((string) $extraLink['url']);
        $scheme = strtolower(parse_url($linkUrl, PHP_URL_SCHEME) ?: '');
        $host = strtolower((string) parse_url($linkUrl, PHP_URL_HOST));
        $isHttpUrl = in_array($scheme, ['http', 'https'], true) && $host !== '';
        $isExternal = $isHttpUrl && $host !== strtolower(request()->getHost());
        $isLocalPath = $scheme === '' && substr($linkUrl, 0, 1) === '/' && substr($linkUrl, 0, 2) !== '//';
        if (!$isHttpUrl && !$isLocalPath) {
            continue;
        }

        $quickLinks[] = [
            'label' => (string) $extraLink['label'],
            'url' => $linkUrl,
            'external' => $isExternal,
        ];
    }
@endphp
<nav class="publisher-internal-quicklinks" aria-label="Quick links">
    <p class="publisher-eyebrow">For authors</p>
    <h2>Quick links</h2>
    <a class="publisher-internal-quicklinks-primary" href="{{ url('manuscript') }}">
        <span><small>Start here</small><strong>Submit manuscript</strong></span>
        <span aria-hidden="true">↗</span>
    </a>
    @foreach ($quickLinks as $link)
        <a href="{{ $link['url'] }}" @if (!empty($link['external'])) target="_blank" rel="noopener noreferrer" @endif>
            {{ $link['label'] }} <span aria-hidden="true">↗</span>
        </a>
    @endforeach
</nav>
