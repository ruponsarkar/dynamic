<?php

namespace App\Support;

use App\Models\articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ArticleAuthors
{
    public static function clean($text): string
    {
        return trim(preg_replace('/\s+/u', ' ', strip_tags((string) $text)));
    }

    public static function fromRequest(Request $request, bool $required = true): ?array
    {
        if (!$required && !$request->boolean('use_structured_authors')) {
            $request->validate(['aname' => 'required|string|max:1000', 'designation' => 'nullable|string|max:5000']);
            return null;
        }
        $data = $request->validate([
            'authors' => 'required|array|min:1|max:50',
            'authors.*' => 'required|array',
            'authors.*.first_name' => 'required|string|max:150',
            'authors.*.last_name' => 'nullable|string|max:150',
            'authors.*.designation' => 'nullable|string|max:255',
            'authors.*.affiliation' => 'nullable|string|max:2000',
            'authors.*.is_corresponding' => 'sometimes|boolean',
            'authors.*.sup_number' => 'nullable|integer|min:1|max:9999',
        ]);
        $rows = [];
        foreach (array_values($data['authors']) as $position => $row) {
            $author = ['position' => $position];
            foreach (['first_name', 'last_name', 'designation', 'affiliation'] as $field) {
                $author[$field] = self::clean($row[$field] ?? '');
            }
            if ($author['first_name'] === '') {
                throw ValidationException::withMessages(['authors' => 'Each author needs a first name.']);
            }
            $author['is_corresponding'] = !empty($row['is_corresponding']);
            $author['sup_number'] = isset($row['sup_number']) && $row['sup_number'] !== '' ? (int) $row['sup_number'] : null;
            $rows[] = $author;
        }
        // Match the existing database column sizes, including generated markup.
        foreach (self::legacy($rows) as $field => $value) {
            $limit = $field === 'aname' ? 1000 : 5000;
            if (mb_strlen($value) > $limit) {
                throw ValidationException::withMessages(['authors' => 'The combined ' . ($field === 'aname' ? 'author names' : 'affiliations') . ' exceed the existing ' . $limit . '-character field limit. Please shorten them.']);
            }
        }
        return $rows;
    }

    public static function legacy(array $authors): array
    {
        $names = [];
        $groups = [];
        foreach ($authors as $author) {
            $name = trim($author['first_name'] . ' ' . ($author['last_name'] ?? ''));
            $number = $author['sup_number'] ?? null;
            $corresponding = !empty($author['is_corresponding']);
            $names[] = e($name) . ($corresponding ? '*' : '') . ($number !== null ? '<sup>' . (int) $number . '</sup>' : '');
            $affiliation = self::clean($author['affiliation'] ?? '');
            if ($affiliation === '') continue;
            $key = mb_strtolower($affiliation);
            if (!isset($groups[$key])) $groups[$key] = ['text' => $affiliation, 'numbers' => [], 'corresponding' => false];
            if ($number !== null) $groups[$key]['numbers'][(int) $number] = (int) $number;
            $groups[$key]['corresponding'] = $groups[$key]['corresponding'] || $corresponding;
        }
        $affiliations = [];
        foreach ($groups as $group) {
            $prefix = implode('-', $group['numbers']) . ($group['corresponding'] ? '*' : '');
            $affiliations[] = ($prefix !== '' ? '<sup>' . $prefix . '</sup>' : '') . e($group['text']);
        }
        return ['aname' => implode(', ', $names), 'designation' => implode(', ', $affiliations)];
    }

    public static function save(articles $article, ?array $authors): void
    {
        DB::transaction(function () use ($article, $authors) {
            if ($authors !== null) {
                foreach (self::legacy($authors) as $field => $value) $article->$field = $value;
            }
            $article->save();
            if ($authors !== null) {
                $article->publicationAuthors()->delete();
                $article->publicationAuthors()->createMany($authors);
            }
        });
    }

    /** Allow only generated numeric superscripts; escape everything else. */
    public static function display($value): string
    {
        $parts = preg_split('~(<sup>[0-9]+(?:-[0-9]+)*\*?</sup>|<sup>\*</sup>)~', (string) $value, -1, PREG_SPLIT_DELIM_CAPTURE);
        return implode('', array_map(function ($part) {
            return preg_match('~^<sup>(?:[0-9]+(?:-[0-9]+)*)?\*?</sup>$~', $part)
                ? $part : e(html_entity_decode($part, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }, $parts));
    }
}
