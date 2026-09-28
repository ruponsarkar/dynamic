<?php

namespace App\Support;

class ScholarlyMetadata
{
    public static function text($value): string
    {
        return trim(preg_replace('/\s+/u', ' ', strip_tags(html_entity_decode((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8'))));
    }

    public static function article($article, $journal, $volume, $issue): array
    {
        $tags = [];
        $add = function ($name, $value) use (&$tags) {
            $value = self::text($value);
            if ($value !== '') {
                $tags[] = ['name' => $name, 'content' => $value];
            }
        };
        // Semicolons/newlines separate authors; commas may be part of "Surname, Given name".
        $authors = array_values(array_filter(array_map('trim', preg_split('/[;\r\n]+/', $article->aname ?? ''))));
        $title = self::text($article->name);
        $abstract = self::text($article->abstract ?? '');
        $url = url('article/' . $article->slug);
        $date = trim($article->published_date ?? '');
        if (!preg_match('/^\d{4}(?:-\d{2}(?:-\d{2})?)?$/', $date)) {
            $date = '';
        }
        if (!$date && preg_match('/^\d{4}$/', (string) ($volume->year ?? ''))) {
            $date = (string) $volume->year;
        }
        $doi = preg_replace('~^(?:https?://(?:dx\.)?doi\.org/|doi:\s*)~i', '', trim($article->doi ?? ''));
        $pdf = !empty($article->file) && strtolower(pathinfo($article->file, PATHINFO_EXTENSION)) === 'pdf'
            ? url('assets/articles/' . $article->file) : null;
        foreach (['citation_title' => $title, 'citation_journal_title' => $journal->j_name,
            'citation_publisher' => $journal->publisher ?? '', 'citation_publication_date' => str_replace('-', '/', $date),
            'citation_volume' => $volume->name ?? '', 'citation_issue' => $issue->name ?? '',
            'citation_doi' => $doi, 'citation_language' => $article->language ?? '',
            'citation_keywords' => $article->keywords ?? '', 'citation_abstract_html_url' => $url,
            'citation_pdf_url' => $pdf, 'DC.Title' => $title, 'DC.Description' => $abstract,
            'DC.Date.issued' => $date, 'DC.Type' => 'Text', 'DC.Type.articleType' => 'Journal Article',
            'DC.Source' => $journal->j_name, 'DC.Publisher' => $journal->publisher ?? '',
            'DC.Language' => $article->language ?? '', 'DC.Rights' => $article->licence ?? '',
            'DC.Identifier' => $url, 'DC.Identifier.DOI' => $doi, 'DC.Subject' => $article->keywords ?? ''] as $name => $value) {
            $add($name, $value);
        }
        foreach ($authors as $author) {
            $add('citation_author', $author);
            $add('DC.Creator', $author);
        }
        preg_match_all('/\b\d{4}-\d{3}[\dXx]\b/', $journal->issn ?? '', $issns);
        foreach (array_unique($issns[0]) as $issn) {
            $add('citation_issn', $issn);
            $add('DC.Source.ISSN', $issn);
        }
        if (preg_match('/^\s*(\d+)\s*(?:[-–—]\s*(\d+))?\s*$/u', $article->page ?? '', $pages)) {
            $add('citation_firstpage', $pages[1]);
            $add('citation_lastpage', $pages[2] ?? '');
        }
        $schema = array_filter([
            '@context' => 'https://schema.org', '@type' => 'ScholarlyArticle', '@id' => $url,
            'url' => $url, 'headline' => $title, 'description' => $abstract,
            'author' => array_map(function ($name) { return ['@type' => 'Person', 'name' => self::text($name)]; }, $authors),
            'datePublished' => $date ?: null, 'inLanguage' => $article->language ?? null,
            'keywords' => self::text($article->keywords ?? ''), 'pagination' => $article->page ?? null,
            'identifier' => $doi ? 'https://doi.org/' . $doi : null,
            'isPartOf' => ['@type' => 'Periodical', 'name' => self::text($journal->j_name), 'issn' => $issns[0], 'url' => url('journal/' . $journal->slug)],
            'publisher' => empty($journal->publisher) ? null : ['@type' => 'Organization', 'name' => self::text($journal->publisher)],
            'encoding' => $pdf ? ['@type' => 'MediaObject', 'encodingFormat' => 'application/pdf', 'contentUrl' => $pdf] : null,
        ], function ($value) { return $value !== null && $value !== '' && $value !== []; });
        return compact('tags', 'schema');
    }
}
