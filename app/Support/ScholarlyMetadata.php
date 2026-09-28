<?php

namespace App\Support;

class ScholarlyMetadata
{
    public static function text($value): string
    {
        return trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $value), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    }

    public static function date($value): ?string
    {
        $value = trim((string) $value);
        foreach (['Y-m-d', 'Y/m/d', 'd-m-Y', 'Y-m-d H:i:s'] as $format) {
            $date = \DateTimeImmutable::createFromFormat('!' . $format, $value);
            if ($date && $date->format($format) === $value) return $date->format('Y-m-d');
        }
        return preg_match('/^[12]\d{3}$/', $value) ? $value : null;
    }

    public static function article($article, $journal, $volume, $issue, iterable $authors): array
    {
        $tags = [];
        $add = function ($name, $value) use (&$tags) {
            $value = self::text($value);
            if ($value !== '') $tags[] = ['name' => $name, 'content' => $value];
        };
        $url = url('article/' . $article->slug);
        $title = self::text($article->name);
        $abstract = self::text($article->abstract ?? '');
        $date = self::date($article->published_date ?? '') ?: self::date($volume->year ?? '');
        $modified = self::date($article->updated_at ?? '');
        $doi = preg_replace('~^(?:https?://(?:dx\.)?doi\.org/|doi:\s*)~i', '', trim($article->doi ?? ''));
        $language = self::text($article->language ?? $journal->language ?? '');
        if (strtolower($language) === 'english') $language = 'en';
        $pdf = !empty($article->file) && strtolower(pathinfo($article->file, PATHINFO_EXTENSION)) === 'pdf' ? url('assets/articles/' . $article->file) : null;
        $volumeNumber = preg_replace('/^vol(?:ume)?\.?\s*/i', '', $volume->name ?? '');
        $issueNumber = preg_replace('/^(?:issue|number|no\.?)\s*/i', '', $issue->name ?? '');
        foreach ([
            'citation_title' => $title, 'citation_journal_title' => $journal->j_name,
            'citation_journal_abbrev' => $journal->abbr_title ?? '', 'citation_publisher' => $journal->publisher ?? '',
            'citation_publication_date' => str_replace('-', '/', $date ?? ''), 'citation_date' => str_replace('-', '/', $date ?? ''),
            'citation_volume' => $volumeNumber, 'citation_issue' => $issueNumber, 'citation_doi' => $doi,
            'citation_language' => $language, 'citation_keywords' => $article->keywords ?? '',
            'citation_abstract_html_url' => $url, 'citation_pdf_url' => $pdf,
            'DC.Title' => $title, 'DC.Description' => $abstract, 'DC.Date.created' => $date, 'DC.Date.issued' => $date,
            'DC.Date.dateSubmitted' => self::date($article->received ?? ''), 'DC.Date.modified' => $modified,
            'DC.Identifier' => $article->id, 'DC.Identifier.URI' => $url, 'DC.Identifier.DOI' => $doi,
            'DC.Identifier.pageNumber' => $article->page ?? '', 'DC.Language' => $language,
            'DC.Source' => $journal->j_name, 'DC.Source.URI' => url('journal/' . $journal->slug),
            'DC.Source.Volume' => $volumeNumber, 'DC.Source.Issue' => $issueNumber,
            'DC.Publisher' => $journal->publisher ?? '', 'DC.Rights' => $article->licence ?? '',
            'DC.Type' => 'Text.Serial.Journal', 'DC.Type.articleType' => $article->article_type ?? '',
            'DC.Format' => $pdf ? 'application/pdf' : null,
            'prism.publicationName' => $journal->j_name, 'prism.publicationDate' => $date,
            'prism.volume' => $volumeNumber, 'prism.number' => $issueNumber, 'prism.doi' => $doi, 'prism.url' => $url,
        ] as $name => $value) $add($name, $value);
        preg_match_all('/\b\d{4}-\d{3}[\dXx]\b/', $journal->issn ?? '', $issns);
        foreach (array_unique($issns[0]) as $issn) {
            $add('citation_issn', $issn);
            $add('DC.Source.ISSN', $issn);
            $add('prism.issn', $issn);
        }
        if (preg_match('/^\s*(\d+)\s*(?:[-–—]\s*(\d+))?\s*$/u', $article->page ?? '', $pages)) {
            $add('citation_firstpage', $pages[1]);
            $add('citation_lastpage', $pages[2] ?? '');
            $add('prism.startingPage', $pages[1]);
            $add('prism.endingPage', $pages[2] ?? '');
        }
        foreach (preg_split('/[,;]+/', $article->keywords ?? '') as $keyword) $add('DC.Subject', $keyword);
        $people = [];
        foreach ($authors as $author) {
            $name = self::text($author->first_name . ' ' . $author->last_name);
            $add('citation_author', $name);
            $add('citation_author_institution', $author->affiliation);
            $add('DC.Creator.PersonalName', $name);
            $person = ['@type' => 'Person', 'name' => $name, 'givenName' => $author->first_name];
            if ($author->last_name) $person['familyName'] = $author->last_name;
            if ($author->designation) $person['jobTitle'] = $author->designation;
            if ($author->affiliation) $person['affiliation'] = ['@type' => 'Organization', 'name' => $author->affiliation];
            $people[] = $person;
        }
        if (!$people) {
            // Do not guess how commas in legacy names should be split.
            $legacy = preg_replace('~<sup>.*?</sup>~is', '', $article->aname ?? '');
            foreach (preg_split('/[;\r\n]+/', $legacy) as $name) {
                $name = trim(self::text(str_replace('*', '', $name)));
                if ($name === '') continue;
                $add('citation_author', $name);
                $add('DC.Creator.PersonalName', $name);
                $people[] = ['@type' => 'Person', 'name' => $name];
            }
        }
        $periodical = ['@type' => 'Periodical', 'name' => self::text($journal->j_name), 'url' => url('journal/' . $journal->slug)];
        if ($issns[0]) $periodical['issn'] = array_values(array_unique($issns[0]));
        $part = $volumeNumber !== '' ? ['@type' => 'PublicationVolume', 'volumeNumber' => $volumeNumber, 'isPartOf' => $periodical] : $periodical;
        if ($issueNumber !== '') $part = ['@type' => 'PublicationIssue', 'issueNumber' => $issueNumber, 'isPartOf' => $part];
        $schema = array_filter([
            '@context' => 'https://schema.org', '@type' => 'ScholarlyArticle', '@id' => $url, 'url' => $url,
            'headline' => $title, 'abstract' => $abstract, 'author' => $people, 'datePublished' => $date,
            'dateModified' => $modified, 'inLanguage' => $language, 'keywords' => self::text($article->keywords ?? ''),
            'pagination' => $article->page ?? null, 'identifier' => $doi ? 'https://doi.org/' . $doi : null,
            'isPartOf' => $part,
            'publisher' => empty($journal->publisher) ? null : ['@type' => 'Organization', 'name' => self::text($journal->publisher)],
            'encoding' => $pdf ? ['@type' => 'MediaObject', 'contentUrl' => $pdf, 'encodingFormat' => 'application/pdf'] : null,
        ], function ($value) { return $value !== null && $value !== '' && $value !== []; });
        return compact('tags', 'schema', 'date', 'pdf');
    }
}
