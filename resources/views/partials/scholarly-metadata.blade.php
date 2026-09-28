<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/">
@foreach ($scholarly['tags'] as $tag)
    <meta name="{{ $tag['name'] }}" content="{{ $tag['content'] }}">
@endforeach
<script type="application/ld+json">{!! json_encode($scholarly['schema'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
