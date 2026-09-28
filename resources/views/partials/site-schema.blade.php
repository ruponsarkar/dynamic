@php
    $siteSchema = ['@context' => 'https://schema.org', '@type' => request()->is('/') ? 'WebSite' : 'WebPage', 'name' => $metaTitle, 'url' => $canonicalUrl, 'description' => \App\Support\ScholarlyMetadata::text($metaDescription)];
    if (request()->is('journal/*') && isset($journal)) {
        $siteSchema['@type'] = 'Periodical';
        $siteSchema['name'] = \App\Support\ScholarlyMetadata::text($journal->j_name);
        preg_match_all('/\b\d{4}-\d{3}[\dXx]\b/', $journal->issn ?? '', $journalIssns);
        if ($journalIssns[0]) $siteSchema['issn'] = array_values(array_unique($journalIssns[0]));
        if (!empty($journal->publisher)) $siteSchema['publisher'] = ['@type' => 'Organization', 'name' => \App\Support\ScholarlyMetadata::text($journal->publisher)];
    }
@endphp
<script type="application/ld+json">{!! json_encode($siteSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
